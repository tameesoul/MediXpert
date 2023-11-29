<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'price',
        'compare_price',
        'store_id',
        'category_id',
        'status'
       ];
    public static function booted()
    {
        static::addGlobalScope('store',new StoreScope());
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class,
        'product_tag', // povit
        'product_id',
        'tag_id',
        'id',
        'id'
    );
    }
}
