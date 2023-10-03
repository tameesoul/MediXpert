<?php
namespace App\Http\Controllers\Dashboard;
use App\Models\Category;
use Exception;
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
        return view('dashboard.categories.create',compact('parents'));
    }

    public function store(Request $request)
    {
        //// $request is an object 

        // $request->input('name'); //// not a good way because you can send data in paramter
        // $request->post('name'); //// more specific it only accept data from the form 
        // $request->query('name'); //// only from the uri
        // $request->name; 
        // $request['name']; //// not a good way 2 you might think that the $request it an array but it an object 
         //// array of the input data
         /// the kay is the name of prob and the value the input
        // $category =  Category::create($request->all());
        // $category->save();
         //// insted of $request->all(); 
         ///and save() method 
         ///mass assignment require add fillable or gurded to the model to prevent added non related inputs
         $request->merge([
            'slug'=>Str::slug($request->post('name'))
         ]);
        $cat =  Category::create($request->all());
         ///PRG //// Post Redirect 
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
        $parents = Category::
        where('id','<>',$id)   
        ->whereNOTNull('parent_id')                
        ->Orwhere('parent_id','<>',$id)->get();
        return view('dashboard.categories.edit',compact('category','parents'));
    }
    public function update(Request $request, string $id)
    {
        $category = Category::findOrfail($id);
        $category->updated($request->all());
        return redirect()->route('dashboard.categories.index')
        ->with('success','category updated');
    }

    public function destroy(string $id)
    {
        // $category = Category::findOrfail($id);
        // $category->delete();
        Category::where('id','=',$id)->delete();
        //Category::destroy($id);
        return redirect()->route('dashboard.categories.index')
        ->with('success','category deleted');
    }
}
