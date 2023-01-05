<?php

namespace App\Http\Livewire;

//use Nette\Utils\Image;
use App\Models\Chambre;
use Livewire\Component;
use App\Models\TypeChambre;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;



class ChambreComp extends Component
{
    use WithPagination, WithFileUploads;
    public $currentPage = CHAMBRELIST;
    protected $paginationTheme = "bootstrap";
    public $search = "";
    public $filtreType = "", $filtreEtat = "";
    public $addChambre = [];
    public $editChambre = [];
    public $addPhoto = null;
    public $editPhoto = null;

    protected $rules = [
        'editChambre.numero_de_chambre' =>"required", //["required", Rule::unique("articles", "nom")->ignore($this->editArticle["id"])],
        'editChambre.EstDisponible' =>"required", //["required", Rule::unique("articles", "noSerie")->ignore($this->editArticle["id"])],
        'editChambre.type_chambe_id' =>"", //'required|exists:App\Models\TypeArticle,id',
        'editChambre.imageUrl' =>""
    ];
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

    public function closeEditModal(){
        $this->dispatchBrowserEvent("closeEditModal");
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
         $imagePath = "images/imageplaceholder.png";
         

         if($this->addPhoto != null){

            //$path = $this->addPhoto->store('upload', 'public');
            $imagePath = $this->addPhoto->store('upload', 'public');
            //$imagePath = "storage/".$path;

            //$image = Image::make(public_path("storage/".$imagePath))->fit(200, 200);
            //$image->save();

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

    public function editChambre(Chambre $chambre){
        $this->editChambre = $chambre->toArray();
         
    }
    public function updateChambre(){
        $this->validate();
        $chambre = Chambre::find($this->editChambre["id"]);
        $chambre->fill($this->editChambre);
        $imagePath = "images/imageplaceholder.png";
        if($this->editPhoto != null){
            $imagePath = $this->addPhoto->store('upload', 'public');
            $chambre->imageUrl = $imagePath;
        }

        $chambre->save();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=> "La chambre a été mis à jour avec succès!"]);
    }

    public function confirmDelete(Chambre $chambre){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message"=> [
            "text" => "Vous êtes sur le point de supprimer la chambre N° ". $chambre->numero_de_chambre ." de la liste des chambres. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" => [
                "chambre_id" => $chambre->id
            ]
        ]]); 
    }

    public function deleteChambre(Chambre $chambre){
        if(count($chambre->locations)>0) return;
        
        if(count($chambre->tarifications) > 0)
            $chambre->tarifications()->where("chambre_id", $chambre->id)->delete();

        $chambre->delete();

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Chambre supprimé avec succès!"]);
    }
}
