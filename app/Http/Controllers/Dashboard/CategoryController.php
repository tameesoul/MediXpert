<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    
    public function index(Request $request)
    {

        $categories = Category::with('parents')->/*leftjoin('categories as parent','parent.id','=','categories.parent_id')
        ->select([
            'categories.*',
            'parent.name as parent_name'
        ])*/
        withCount(['products as products_numbers'=>function($query){
            $query->where('status','active');
        }])
        ->
        Filter($request->query())
        ->paginate(3);
        
        return view('dashboard.categories.index', compact('categories'));
    }

  
    public function create()
    {
        $parents = Category::all(); 
        $category = new  Category();
        return view('dashboard.categories.create',compact('parents','category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $request->merge([
            'slug'=>Str::slug($request->post('name'))
        ]);
        $date = $request->except('image'); 
        $date['image'] = $this->uploadimage($request);
        Category::create($date);
        return Redirect::route('dashboard.categories.index')
        ->with('success','category has been created .');
    }
    public function show(Category $category)
    {
        return view('dashboard.categories.show',[
            'category'=>$category
        ]);
    }

    public function edit(string $id)
    {
        try {
            $category = Category::findOrFail($id);
        } catch (\Exception $e) {
            return Redirect::route('dashboard.categories.index')
            ->with('danger','unknown category.');
        }
        $parents = Category::where('id','<>',$id)
            ->where(function($query)use($id){
            $query->whereNull('parent_id')
            ->orWhere('parent_id','<>',$id);
        })->get();
        return view('dashboard.categories.edit', compact('parents', 'category'));
    }

  
    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::findOrfail($id);
        $old_image = $category->image;
        $date = $request->except('image');
         $path= $this->uploadimage($request);
         if($path)
         {
            $date['image'] = $path;
         }
        $category->update($date);
        if($old_image&&isset($date['image']))
        {
            Storage::disk('public')->delete($old_image);
        }
        return Redirect::route('dashboard.categories.index')->with('success','category has been updated');
    }

    public function destroy(string $id)
    {
        Category::where('id',$id)->delete();
        return Redirect::route('dashboard.categories.index')->with('danger','category moved to trashes');
    }

    public function uploadimage(Request $request)
    {
        if(!$request->hasFile('image'))
                 return;
        {
           $file = $request->file('image');
           $path =   $file->store('uploads',[
                'disk'=>'public'
            ]);
            return $path;
        }
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash',compact('categories'));
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrfail($id);
        $category->restore();
        return Redirect::route('dashboard.categories.trash')->with('success','category has been restored');
    }

    public function force_delete(Request $request , $id)
    {
        $category= Category::onlyTrashed()->findOrfail($id);
        $category->forceDelete();
        return redirect()->route('dashboard.categories.trash')
        ->with('danger','category deleted forever!');
    }
}
