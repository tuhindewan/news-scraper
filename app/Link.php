<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';
    protected $fillable = ['url', 'main_filter_selector', 'website_id', 'category_id'];

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
