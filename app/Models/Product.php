<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public function ScopeActive(Builder $builder)
    {
        $builder->where('status','=','active');
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://www.incathlab.com/images/products/default_product.png';
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }

    
}
