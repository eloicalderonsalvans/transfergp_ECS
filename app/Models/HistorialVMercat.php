<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialVMercat extends Model
{
    protected $fillable = ['id_pilot', 'data_valoracio', 'valor_mercat'];

    public function pilot()
    {
        return $this->belongsTo(Pilot::class);
    }
}
