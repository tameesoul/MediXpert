<?php
namespace App\Models;
use App\Models\Store;
use App\Models\Category;
use App\Models\Scopes\StoreScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
   // protected   $table = "products";


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
    protected static function booted()
    {
        static::addGlobalScope('store',new StoreScope());
    }

    public function categories()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function stores()
    {
        return $this->belongsTo(Store::class,'store_id','id');
    }

    public function Tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
