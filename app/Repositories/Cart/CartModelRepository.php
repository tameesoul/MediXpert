<?php

namespace App\Repositories\Cart;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Database\Eloquent\Collection;

class CartModelRepository implements CartRepository
{

    public function get(): Collection
    {
        return Cart::where('cookie_id', '=', $this->getCookieId())->get();
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

    public function update($product, $quantity)
    {
        return Cart::where('cookie_id', '=', $this->getCookieId())
            ->update([
                'quantity' => $quantity
            ]);
    }
    

    public function delete($id)
    {
        return Cart::where('id','=',$id)
        ->where('cookie_id',$this->getCookieId())
        ->delete();
    }

    public function empty()
    {
        Cart::where('cookie_id', '=', $this->getCookieId())->delete();
    }

    public function total(): float
    {
        $result = Cart::join('products', 'products.id', '=', 'carts.product_id')
            ->selectRaw('SUM(products.price * carts.quantity) as total')
            ->value('total');
    
        return $result ? (float) $result : 0.0;
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