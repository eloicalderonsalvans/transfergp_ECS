<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fabricant extends Model
{
    protected $fillable = ['nom', 'descripcio', 'pais_origen', 'm_constructors', 'actiu' ,'logo_url'];

    public function equips()
    {
        return $this->hasMany(Equip::class);
    }
}
