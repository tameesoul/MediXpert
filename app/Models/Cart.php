<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    public $incrementing = false; 

    protected $fillable = 
    [
        'cookie_id', 'user_id', 'product_id', 'quantity', 'options',
    ]; 


    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name'=>'anonymous'
        ]);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function booted()
    {
        Cart::creating(function(Cart $cart){
            $cart->id = Str::uuid();
        });
    }
}
