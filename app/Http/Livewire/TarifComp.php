<?php

namespace App\Http\Livewire;

use App\Models\Chambre;
use Livewire\Component;
use App\Models\Tarification;
use App\Models\DureeLocation;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class TarifComp extends Component
{
    public Chambre $chambre;
    public $newTarif = [];
    public $isAddTarif = false;

    public function mount($chambreId){
        $this->chambre = Chambre::find($chambreId);
    }

    public function render()
    {
        return view('livewire.tarifs.index',[
            "tarifs" => Tarification::with(["dureeLocation"])
            ->whereChambreId($this->chambre->id) 
            ->get(),
            "dureeLocation" => DureeLocation::all()
        ])
        ->extends("layouts.master")
        ->section("contenu");
    }

    public function nouveauTarif(){
        $this->isAddTarif = true;
    }

    public function editTarif(Tarification $tarif){
        $this->isAddTarif = true;
        $this->newTarif = $tarif->toArray();
        $this->newTarif["edit"] = true;
    }

    public function saveTarif(){
        $chambreId = $this->chambre->id;
        $newTarif = $this->newTarif;

        $uniqueRule = function() use($newTarif,$chambreId){
            return (isset($newTarif["edit"]))?
            Rule::unique((new Tarification)->getTable(), "duree_location_id")
                ->ignore($newTarif["id"], "id")
                ->where(function($query) use ($chambreId){
                    return $query->where("chambre_id", $chambreId);
                })
            : 
            Rule::unique((new Tarification)->getTable(), "duree_location_id")
                ->where(function($query) use ($chambreId){
                    return $query->where("chambre_id", $chambreId);
                });
        };
        
        $this->validate([
            "newTarif.duree_location_id" => [
                "required",
                $uniqueRule()
            ],
            "newTarif.prix" => "required|numeric"
            ],
            ["newTarif.duree_location_id.unique" => "Il existe déjà un tarif pour cette durée location..."]
        );

        Tarification::updateOrCreate(
            [
                "duree_location_id" => $this->newTarif["duree_location_id"],
                "chambre_id" => $chambreId
            ],
            [
                "prix" => $this->newTarif["prix"]
            ]
            );

            $this->cancel();

    }

    public function cancel(){
        $this->isAddTarif = false;
        $this->resetErrorBag();
        $this->newTarif = [];
    }
}
