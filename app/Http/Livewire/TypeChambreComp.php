<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\TypeChambre;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class TypeChambreComp extends Component
{
    use WithPagination;
    public $search = "";
    public $isAddTypeChambre = false;
    public $newTypeChambreName = "";
    public $newValue = "";
    protected $paginationTheme = "bootstrap";

    public function render()
    {
        Carbon::setLocale("fr");
        $searchcriteria = "%".$this->search."%";
        $data =[
            "typechambres" => TypeChambre::where("Description", "like", $searchcriteria)->latest()->paginate(2)
        ];
        return view('livewire.typechambres.index', $data)
                ->extends("layouts.master")
                ->section("contenu");
        /*return view('livewire.typechambres.index', [
            "typechambres" => TypeChambre::latest()->paginate(5)
                ])
            ->extends("layouts.master")
            ->section("contenu");*/
    }

    public function toggleShowAddTypeChambreForm(){
        if($this->isAddTypeChambre){
           $this->isAddTypeChambre = false;
           $this->newTypeChambreName = "";
           $this->resetErrorBag(["newTypeChambreName"]);
        }else{
           $this->isAddTypeChambre = true;
        }
   }

  public function addNewTypeChambre(){
    $validated = $this->validate([
        "newTypeChambreName" => "required|max:50|unique:type_chambres,Description"
    ]);

    TypeChambre::create(["Description"=> $validated["newTypeChambreName"]]);

    $this->toggleShowAddTypeChambreForm();
    $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Type de chambre ajouté à jour avec succès!"]);

}

public function editTypeChambre(TypeChambre $typeChambre){
    $this->dispatchBrowserEvent("showEditForm", ["typechambre" => $typeChambre]);
}

public function updateTypeChambre(TypeChambre $typeChambre, $valueFromJS){
    $this->newValue = $valueFromJS;
    $validated = $this->validate([
        "newValue" => ["required", "max:50", Rule::unique("type_chambres", "Description")->ignore($typeChambre)]
    ]);

    $typeChambre->update(["Description"=> $validated["newValue"]]);

    $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Type de chambre mis à jour avec succès!"]);

}

public function confirmDelete($name, $id){
    $this->dispatchBrowserEvent("showConfirmMessage", ["message"=> [
        "text" => "Vous êtes sur le point de supprimer $name de la liste des types de chambre. Voulez-vous continuer?",
        "title" => "Êtes-vous sûr de continuer?",
        "type" => "warning",
        "data" => [
            "type_chambre_id" => $id
        ]
    ]]);
}


public function deleteTypeChambre(TypeChambre $typeChambre){
    $typeChambre->delete();
    $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Type de chambre supprimé avec succès!"]);
}
}
