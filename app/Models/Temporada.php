<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temporada extends Model {
    protected $fillable = ['nom', 'any'];
    public function granPremis() { return $this->hasMany(GranPremi::class); }
    public function competicions() { return $this->belongsToMany(Competicio::class, 'competicio_temporada'); }
}
