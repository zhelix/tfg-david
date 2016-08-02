<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data extends Model
{
    protected $fillable = [
        'temp',
        'hum',
        'gas',
        'luz',
        'noise',
        'poslon',
        'poslat',
        'board_id'

    ];
}
