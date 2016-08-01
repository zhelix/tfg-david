<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data extends Model
{
    protected $fillable = [
        'created_at',
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
