<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $guarded = [];

    protected $casts = [
        'allDay' => 'boolean',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
