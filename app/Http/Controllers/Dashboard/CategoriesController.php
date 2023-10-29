<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index(Request $request) /// i call the request from the services container 
    {
       // $request = request(); ///// i got the object or i can pass it in fn paramter 
       // $categories = $query->paginate(2);
       $categories = Category::leftJoin('categories as parents', 'categories.parent_id', '=', 'parents.id')
       ->select([
           'categories.*',
           'parents.name as parents_name'
       ])->
       withCount('products')
       ->filter($request->query())
        ->orderBy('name')
        ->paginate(10);
        return view('dashboard.categories.index',compact('categories'));
    }

    public function create()
    {

        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create',compact('category','parents'));
    }

    public function store( CategoryRequest $request)
    {

      //  $request->validate(Category::rules());
        $request->merge([
            'slug'=>Str::slug($request->post('name'))
          ]);
        $data = $request->except('image');
        $data['image'] = $this->uploadimage($request);
         Category::create($data);
         return redirect(route('dashboard.categories.index'))
         ->with('success','category added successfully');
    }
    public function show(Category $category)
    {       
      //  $products = Product::with('categories','store');
        return view('dashboard.categories.show',[
            'category'=> $category
        ]);   
    }

    public function edit(string $id)
    {
        try{
            $category = Category::findOrfail($id);
        } catch (Exception $e) {
            return redirect()->route('dashboard.categories.index')
            ->with('info','category is not found');
        }
        //select * from categories where pareant_id is null or  <> $id and id <> id
        $parents = Category::where('id','<>',$id)
            ->where(function($query)use($id){
            $query->whereNull('parent_id')
            ->orWhere('parent_id','<>',$id);
        })->get();
        return view('dashboard.categories.edit',compact('category','parents'));
    }
    public function update( CategoryRequest $request, string $id)
    {
       // $request->validate(Category::rules($id));
    $category = Category::findOrFail($id);
    $old_image = $category->image;

    $request->merge([
            'slug'=>Str::slug($request->post('name'))
          ]);

        $data = $request->except('image');

       $new_image = $this->uploadimage($request);
       if($new_image)
       {
        $data['image']= $new_image;
       }

        $category->update($data);

        if($old_image && $new_image)

         {
        Storage:: disk('public')->delete($old_image);
         }

         return redirect()->route('dashboard.categories.index')
        ->with('success', 'Category updated');
}
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        // if($category->image)
        // {
        //     Storage::disk('public')->delete($category->image);
        // }
        return redirect()->route('dashboard.categories.index')
        ->with('success','category deleted');
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
        $categories = Category::onlyTrashed()->orderBy('id','desc')->paginate(10);
        return view('dashboard.categories.trash',compact('categories'));
    }

    public function restore(Request $request,$id)
    {
    $category = Category::onlyTrashed()->findOrfail($id);
    $category->restore();
    return redirect()->route('dashboard.categories.trash')
        ->with('success','category restored.');
    }
    public function forceDelete(Request $request,$id)
    {
        $category= Category::onlyTrashed()->findOrfail($id);
        $category->forceDelete();
        return redirect()->route('dashboard.categories.trash')
        ->with('success','category deleted.');
    }
}
