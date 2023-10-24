<?php
namespace App\Models;
use App\Models\Scopes\StoreScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
   // protected   $table = "products";
    protected static function booted()
    {
        static::addGlobalScope('store',new StoreScope());
    }
}
