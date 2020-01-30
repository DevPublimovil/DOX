<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $guarded = [];

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function entrega()
    {
        return $this->belongsTo(Entrega::class);
    }
}
