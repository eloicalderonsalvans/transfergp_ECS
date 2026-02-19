<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pilot extends Model {
   protected $fillable = [
        'Nom', 
        'Cognom', 
        'Nacionalitat', 
        'Data_neixament', 
        'Numero', 
        'Estat_actiu', 
        'Mundials_guanyats', 
        'ID_Equip',
        'Foto_url',
    ];
    public function equip() 
    { 
        return $this->belongsTo(Equip::class, 'ID_Equip', 'id'); 
    }

    public function clasificacions() { return $this->hasMany(Clasificacio::class); }
    public function historials() { return $this->hasMany(HistorialVMercat::class); }
}
