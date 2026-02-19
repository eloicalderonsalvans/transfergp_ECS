<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clasificacio extends Model {
    protected $fillable = ['id_pilot', 'gran_premi_id', 'posicio', 'punts','temps', 'estat', 'volta_rapida'];
    public function pilot() { return $this->belongsTo(Pilot::class); }
    public function granPremi() { return $this->belongsTo(GranPremi::class); }
}
