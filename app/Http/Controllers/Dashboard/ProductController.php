<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tag;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    
    public function index()
    {
        $user = Auth::user();
        if($user->store_id)
        {
        $products = Product::where("store_id",'=', $user->store_id)->paginate();
        }
        else
        $products = Product::with('categories','stores')->paginate(10);
        return view("dashboard.products.index", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrfail($id);
        $tags = implode(',',$product->tags()->pluck('name')->toArray());
        return view('dashboard.products.edit',compact('product','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->except('tags'));
        $tags = explode(',',$request->post('tags'));
        $tags_id = [];
        $saved_tags = Tag::all();

        foreach($tags as $t_name)
        {
            $slug = Str::slug($t_name);
            $tag = Tag::where('slug', '=', $slug)->first();
            if(!$tag)
            {
                $tag = Tag::create([
                    'name'=>$t_name,
                    'slug'=>$slug,
                ]);
            }
            $tags_id[] = $tag->id;
        }
        $product->tags()->sync($tags_id);
        return redirect()->route('dashboard.products.index')
        ->with('success','product Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
