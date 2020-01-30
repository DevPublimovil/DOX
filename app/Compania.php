<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compania extends Model
{
    protected $guarded = [];

    public function Contry(){
        return $this->belongsTo(Country::class);
    }
}
