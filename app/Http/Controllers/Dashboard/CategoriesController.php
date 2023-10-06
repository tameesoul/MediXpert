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
        $categories = Category::all();
        return view('dashboard.categories.index',compact('categories'));
    }

    public function create()
    {

        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create',compact('category','parents'));
    }

    public function store(Request $request)
    {
        $request->validate(Category::rules());
            $request->merge([
                'slug'=>Str::slug($request->post('name'))
             ]);
             $data = $request->except('image');
         if($request->hasFile('image'))
         {
            $file = $request->file('image'); 
            $path = $file->store('uploads',[
                'disk'=>'public'
            ]); //// take the file object to the local disk , store function take 2  or1
            /// paramters  "uploads " the file name in the app dir by this you will store the file within loacl desk but 
            /// browser cant get this disk , $path is image path 
            $data['image'] = $path; 
         }
         ///mass assignment
         Category::create($data);
         ///PRG //// Post Redirect GET
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
    public function update(CategoryRequest $request, string $id)
    {
    $category = Category::findOrFail($id);
    $old_image = $category->image;
    $data = $request->except('image');
    $request->merge([
        'slug' => Str::slug($request->post('name'))
    ]);
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $path = $file->store('uploads', [
            'disk' => 'public'
        ]);
        // $file->getClientOriginalName();
        // $file->getSize();
        // $file->getClientOriginalExtension();
        $data['image'] = $path;
    }
    $category->update($data);
    if ($old_image && isset($data['image'])) {
        Storage::disk('public')->delete($old_image);
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
}
