<?php

namespace App\Http\Livewire;

use App\Models\Chambre;
use App\Models\TypeChambre;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ChambreComp extends Component
{
    use WithPagination, WithFileUploads;
    public $currentPage = CHAMBRELIST;
    protected $paginationTheme = "bootstrap";
    public $search = "";
    public $filtreType = "", $filtreEtat = "";
    public $addChambre = [];
    public $addPhoto = null;
    // public $proprietesChambres = []; pour les propriété
    public function render()
    {

        Carbon::setLocale("fr");

        $chambreQuery = Chambre::query();

        if($this->search != ""){
            $chambreQuery->where("numero_de_chambre", "LIKE" ,"%".$this->search."%");
        }

        if($this->filtreType != ""){
            $chambreQuery->where("type_chambre_id", "LIKE" ,"%".$this->filtreType."%");
        }

        if($this->filtreEtat != ""){
            $chambreQuery->where("EstDisponible", "LIKE" ,"%".$this->filtreEtat."%");
        }

        return view('livewire.chambres.index', [
            "chambres"=>$chambreQuery->latest()->paginate(5),
            "typechambres"=>TypeChambre::orderBy("Description","ASC")->get(),
        ])
               ->extends("layouts.master")
               ->section("contenu");
    }

    public function closeModal(){
        $this->dispatchBrowserEvent("closeModal");
    }
    // public function updated($property){ pour les propriétés
    //     if($property == "addArticle.type"){
    //         $this->proprietesArticles = optional(TypeChambre::find($this->addChambre["type"]))->proprietes;
    //     }
    // }

    public function ajoutChambre(){
        // dump($this->addChambre);

         $validateArr = [
            "addChambre.numero_de_chambre" => "string|min:3|required|unique:chambres,numero_de_chambre",
            "addChambre.EstDisponible" => "required",
            "addChambre.type" => "required",
            "addPhoto" => "image|max:10240" // 10mb
     ];

     //$this->validate($validateArr);

        // $customErrMessages = [];
        // $propIds = [];



        // foreach ($this->proprietesArticles?: [] as $propriete) {

        //     $field = "addArticle.prop.".$propriete->nom;

        //     $propIds[$propriete->nom] = $propriete->id;


        //     if($propriete->estObligatoire == 1){
        //         $validateArr[$field] = "required";
        //         $customErrMessages["$field.required"] = "Le champ <<".$propriete->nom.">> est obligatoire.";
        //     }else{
        //         $validateArr[$field] = "nullable";
        //     }


        // }

        // // Validation des erreurs
        $validatedData = $this->validate($validateArr);

         // par défaut notre image est une placeholder
        //  $imagePath = "images/imageplaceholder.png";
         $imagePath = "";

         if($this->addPhoto != null){

            //  $path = $this->addPhoto->store('upload', 'public');
            $imagePath = $this->addPhoto->store('upload', 'public');
            //  $imagePath = "storage/".$path;

            //  $image = Image::make(public_path($imagePath))->fit(200, 200);
            //  $image->save();

         }

         $chambre = Chambre::create([
             "numero_de_chambre" => $validatedData["addChambre"]["numero_de_chambre"],
             "EstDisponible" => $validatedData["addChambre"]["EstDisponible"],
             "type_chambre_id" => $validatedData["addChambre"]["type"],
            "imageUrl" => $imagePath
         ]);



        // foreach($validatedData["addArticle"]["prop"]?: [] as $key => $prop){
        //     ArticlePropriete::create([
        //         "article_id" => $article->id,
        //         "propriete_article_id" => $propIds[$key],
        //         "valeur"=> $prop
        //     ]);
        // }
        

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"La chambre a été ajouté avec succès!"]);

         $this->closeModal();


    }

    public function ListDesChambres(){
        $this->currentPage = CHAMBRELIST;
    }

    public function showAddChambreModal(){
        $this->dispatchBrowserEvent("showModal");
    }

    public function ModifierChambre(){
        $this->currentPage = CHAMBREEDITFORM;
    }

    public function editChambre(){

    }

    public function confirmDelete(){

    }

}
