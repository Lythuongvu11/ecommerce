<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{


    protected $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }


    public function index()
    {
        $products =  $this->product->paginate(12);

        return view('client.home.index', compact('products'));
    }
    //search
    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where( 'name','like', '%' . $query . '%')
                            ->orWhere('description', 'like', '%' . $query . '%')
                            ->paginate(12);
        return view('client.home.search', compact('products','query'));
    }
}
