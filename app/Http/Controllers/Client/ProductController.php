<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $category_id)
    {
        $products =  $this->product->getBy($request->all(), $category_id);

        return view('client.home.index', compact('products'));

    }
    public function filteredProducts(Request $request)
    {
        $category = $request->input('category'); // Lấy mã danh mục từ request

        $query = Product::query();

        if ($category) {
            $query = $query->where('category_id', $category);
        }

        $products = $query->get();

        return response()->json([
            'products' => $products
        ]);
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
    public function show(string $id, Request $request)
    {
        $product = $this->product->with('details')->findOrFail($id);
        return view('client.products.detail', compact('product'));

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
