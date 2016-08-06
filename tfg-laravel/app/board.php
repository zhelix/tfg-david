<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class board extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'linkID',
        'user_id'
    ];
}
