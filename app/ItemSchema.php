<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemSchema extends Model
{
    protected $table = 'item_schemas';
    protected $fillable = ['title', 'is_full_url', 'css_expression', 'full_content_selector'];
}
