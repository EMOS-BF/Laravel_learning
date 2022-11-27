<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    public function user(){
        return $this-> belongsTo(User::class);
       }

    public function client(){
        return $this-> belongsTo(Client::class);
       }

    public function statut(){
        return $this-> belongsTo(StatutLocation::class, "satut_location_id","id");
       }
     public function payement(){
        return $this-> hasMany(Payement::class);
       }

    public function chambre(){
        return $this-> belongsToMany(Chambre::class,"chambre_locations",'location_id','chambre_id');
       }
    
}
