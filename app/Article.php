<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function website()
    {
        return $this->belongsTo(Website::class, 'website_id');
    }
}
