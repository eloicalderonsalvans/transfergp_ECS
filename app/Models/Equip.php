<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equip extends Model {
    protected $fillable = ['nom', 'descripcio', 'director_general', 'logo_url', 'actiu', 'fabricant_id'];
    public function fabricant() { return $this->belongsTo(Fabricant::class); }
    public function pilots() { return $this->hasMany(Pilot::class); }
    public function competicions() { return $this->belongsToMany(Competicio::class, 'competicio_equip'); }
}
