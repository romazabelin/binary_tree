<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Binary extends Model
{
    protected $fillable = ['parent_id', 'position', 'path', 'level'];
}
