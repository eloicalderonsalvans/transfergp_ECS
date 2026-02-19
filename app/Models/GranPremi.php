<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GranPremi extends Model {
    
    protected $fillable = ['nom_gp', 'nom_circuit', 'localitzacio', 'capacitat', 'temporada_id'];
    public function temporada() { return $this->belongsTo(Temporada::class); }
}
