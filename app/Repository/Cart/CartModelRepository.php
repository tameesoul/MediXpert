<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;


class CartModelRepository implements CartRepository
{

    public function get()
    {
        return Cart::where('cookie_id','=',$this->getCookieId());
    }

    public function add(Product $product ,$quantity = 1)
    {
        return Cart::create([
            'cookie_id'=>$this->getCookieId(),
            'user_id'=>Auth::id(),
            'product_id'=>$product->id, 
            'quantity' =>$quantity
        ]);
    }

    public function update(Product $product,$quantity)
    {
        return Cart::where('cookie_id','=',$this->getCookieId())
        ->update([
            'quantity'=>$quantity
        ]);
    }

    public function delete(Product $product)
    {
        return Cart::where('product_id','=',$product)
        ->where('cookie_id',$this->getCookieId())
        ->delete();
    }

    public function empty()
    {
        Cart::where('cookie_id','=',$this->getCookieId());
    }

    public function total() :float
    {
        return Cart::join('products','products.id','=','carts.product_id' )
        ->selectRaw('SUM(products.price * carts.quantity as total)')->value('total');
    }

    public function getCookieId()
    {
        $cookie_id = Cookie::get('cart_id');
        if(!$cookie_id)
        {
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id',$cookie_id,30 * 24 * 60);
        }
        return $cookie_id;
    }
}