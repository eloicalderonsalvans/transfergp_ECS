<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competicio extends Model {
    protected $fillable = ['nom'];
    public function equips() { return $this->belongsToMany(Equip::class, 'competicio_equip'); }
    public function temporades() { return $this->belongsToMany(Temporada::class, 'competicio_temporada'); }
}
