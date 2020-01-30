<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(Document::class);
    }
}
