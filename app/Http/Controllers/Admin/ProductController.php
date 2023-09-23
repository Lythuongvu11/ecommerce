<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\CreatProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Storage;

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
//        return response()->json([
//            'products'=>$products,
//        ]);
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
        $image = $request->file('image');
        if ($image) {
            // Lưu tệp ảnh vào thư mục lưu trữ
            $imagePath = $image->storeAs('public/product_images', $image->getClientOriginalName());
//            $imagePath = $image->store('public/product_images');

            // Loại bỏ tiền tố "public/" từ đường dẫn tệp ảnh
            $imagePath = str_replace('public/', '', $imagePath);
            // Gán đường dẫn tệp ảnh cho sản phẩm
            $validatedData['image'] = $imagePath;
        }

        // Create the product
        $product = new Product($validatedData);
        $product->save();
        return response()->json(['message' => 'Create success']);
        // return redirect()->route('products.index')->with(['message', 'Product created '.$product->name. 'successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)

    {
        $product=$this->product->findOrFail($id);
        return response()->json([
            'product'=>$product,
        ]);
//        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $validatedData = $request->all();
        $product=$this->product->findOrFail($id);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/product_images');
            $imagePath = str_replace('public/', '', $imagePath);
            $validatedData['image'] = $imagePath;
        }

        $product->update($validatedData);
        return response()->json(['message' => 'Update success']);

//        return redirect()->route('products.index')->with('message', 'Product updated '.$product->name. ' successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = $this->product->findOrFail($id);
        Storage::delete('public/' . $product->image);
        $product->delete();
        return response()->json(['message' => 'Delete success']);


//        return redirect()->route('products.index')->with('message', 'Product deleted successfully.');
    }

    public function deleteSelected(Request $request)
    {
        $selectedProductIds =  $request->input('products', []);
        if (!empty($selectedProductIds)) {
            $selectedProducts = Product::whereIn('id', $selectedProductIds)->get();

            foreach ($selectedProducts as $product) {
                Storage::delete('public/' . $product->image);
                $product->delete();
            }
                return response()->json(['message' => 'Delete success']);
//            return redirect()->route('products.index')->with('message', 'Selected products have been deleted.');
        }
            return response()->json(['message' => 'No products selected for deletion.']);
//        return redirect()->route('products.index')->with('message', 'No products selected for deletion.');
    }
    public function showdata(Request $request)
    {
        $query = Product::query();

        // Lấy giá trị tìm kiếm từ yêu cầu
        $search = $request->input('search');

        if ($search) {
            // Sử dụng phương thức where để thêm điều kiện tìm kiếm
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }

        // Thực hiện truy vấn và lấy dữ liệu sản phẩm
        $data = $query->get();

        return $data;
    }

}
