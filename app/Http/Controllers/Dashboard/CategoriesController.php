<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(2);
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
    public function show(string $id)
    {
       
        
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
        if($category->image)
        {
            Storage::disk('public')->delete($category->image);
        }
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
}
