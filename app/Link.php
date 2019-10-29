<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function website()
    {
        return $this->belongsTo(Website::class, 'website_id');
    }

    public function itemSchema()
    {
        return $this->belongsTo(ItemSchema::class, 'item_schema_id');
    }
}
