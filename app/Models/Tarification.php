<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarification extends Model
{
    protected $fillable = ["chambre_id", "duree_location_id", "prix"];
    use HasFactory;
    public function dureeLocation(){
        return $this-> belongsTo(DureeLocation::class, "duree_location", "id");
       }

    public function chambre(){
        return $this-> belongsTo(Chambre::class);
       }

    public function getPrixForHumansAttribute(){
        return number_format($this->prix, 0, ",", " ") . " " . env("CURRENCY", "XAF");
    }
}
