<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class board extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'status',
        'linkID',
        'user_id'
    ];
}
