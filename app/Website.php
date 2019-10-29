<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $table = 'websites';
    protected $fillable = ['title', 'url'];
}
