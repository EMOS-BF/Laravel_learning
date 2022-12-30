<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeChambre extends Model
{
    use HasFactory;
    protected $table = "type_chambres";
    protected $fillable = ["Description"];
    public function chambres(){
        return $this-> hasMany(Chambre::class);
       }
}
