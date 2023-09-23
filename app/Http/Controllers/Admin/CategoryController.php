<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\CreateCategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=$this->category->latest('id')->paginate(5);
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategories = $this->category->all();
        return view('admin.categories.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        $dataCreate=$request->all();
        $category=$this->category->create($dataCreate);
        return response()->json(['message' => 'Create success']);
//        return redirect()->route('categories.index')->with(['message'=>'create new category:'.$category->name.' success']);
    }

    /**
     * Display the specified resource.
     */
    public function showdata()
    {
        $categories = Category::get();
        return $categories;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category=$this->category->findOrFail($id);
        return response()->json(['category' => $category]);
//        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataUpdate = $request->all();
        $category = $this->category->findOrFail($id);
        $category->update($dataUpdate);
//        return redirect()->route('categories.index')->with(['message' => 'Update  category: '. $category->name." success"]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = $this->category->findOrFail($id);

        $category->delete();
        return response()->json(['message' => 'Delete success']);
//        return redirect()->route('categories.index')->with(['message' => 'Delete  category: '. $category->name." success"]);

    }
}
