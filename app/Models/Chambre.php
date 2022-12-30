<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chambre extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "numero_de_chambre",
        "EstDisponible",
        "type_chambre_id",
        "imageUrl",
    ];


   public function type(){
    return $this-> BelongsTo(TypeChambre::class,'type_chambre_id','id');
   }

   public function tarifications(){
    return $this-> hasMany(Tarification::class,'chambre_id','id');
   }

   public function locations(){
    return $this-> belongsToMany(Location::class,"chambre_locations",'chambre_id','location_id');
   }

}
