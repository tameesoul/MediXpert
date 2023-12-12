<?php

namespace App\Http\Controllers\front;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
class CartController extends Controller
{
    public function index(CartRepository $cart)
    {
        $cart = $cart->get();
        return view('front.cart',[
            'item'=>$cart
        ]);
    }
    public function store(Request $request , CartRepository $cart)
    {
        $request->validate([
            'product_id'=>['required','int','exists:products,id'],
            'quantity'=>['nullable','int','min:1']
        ]);

        $product =  Product::findOrFail($request->post('product_id'));
        $cart->add($product,$request->post('quantity'));
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CartRepository $cart)
    {
        $request->validate([
            'product_id'=>['required','int','exists:products,id'],
            'quantity'=>['nullable','int','min:1']
        ]);

        $product = Product::findOrFail($request->post('product_id'));
        $cart->update($product,$request->post('quantity'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartRepository $cart  , $id)
    {
        $cart->delete($id);
    }
}
