<?php
namespace App\Http\Controllers\Dashboard;
use App\Models\Category;
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
         return redirect(route('categories.index'))
         ->with('success','category added successfully');
    }

    public function show(string $id)
    {
        
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
