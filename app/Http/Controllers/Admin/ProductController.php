<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\CreatProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;
    public function __construct(Product $product)
    {
        $this->product=$product;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 50);
        $query=$this->product->latest('id');
        // Search functionality
        $search = $request->input('search');
        if ($search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%");
        }

        $products=$query->paginate($perPage);
        return view('admin.products.index',compact('products','search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatProductRequest $request)
    {
        $validatedData = $request->all();

        // Upload the image file
        $imagePath = $request->file('image')->store('public/product_images');
        // Remove "public/" from the image path
        $imagePath = str_replace('public/', '', $imagePath);

        // Create the product
        $product = new Product($validatedData);
        $product->image = $imagePath;
        $product->save();

        return redirect()->route('products.index')->with(['message', 'Product created'.$product->name. 'successfully.']);
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
