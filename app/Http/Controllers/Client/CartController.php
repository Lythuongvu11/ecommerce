<?php

namespace App\Http\Controllers\Client;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $sessionCart = Session::get('cart', []);

        if ($user) {
            // Nếu người dùng đã đăng nhập, kiểm tra xem có giỏ hàng của họ trong cơ sở dữ liệu không
            $cart = Cart::where('user_id', $user->id)->first();

            if ($cart) {
                // Lấy danh sách sản phẩm trong giỏ hàng của người dùng đã đăng nhập
                $cartProducts = $cart->cartProducts;
                // Hợp nhất sản phẩm trong giỏ hàng Session vào giỏ hàng của người dùng đã đăng nhập
                foreach ($sessionCart as $item) {
                    $cartProduct = new CartProduct([
                        'product_id' => $item['product_id'],
                        'product_name' => $item['product_name'],
                        'product_size' => $item['product_size'],
                        'product_quantity' => $item['product_quantity'],
                        'product_color' => $item['product_color'],
                        'product_price' => $item['product_price'],
                    ]);

                    $cart->cartProducts()->save($cartProduct);
                }

                // Xóa giỏ hàng Session sau khi hợp nhất
                Session::forget('cart');

                // Tính tổng giá trị giỏ hàng
                $totalPrice = $cartProducts->sum(function ($cartProduct) {
                    return $cartProduct->product_price * $cartProduct->product_quantity;
                });
            } else {
                // Nếu người dùng đã đăng nhập nhưng chưa có giỏ hàng, sử dụng giỏ hàng Session
                $cartProducts = $sessionCart;
            }
        } else {
            // Nếu người dùng chưa đăng nhập, sử dụng giỏ hàng Session
            $cartProducts = $sessionCart;
        }
        $totalPrice = 0;
        foreach ($cartProducts as $item) {
            $totalPrice += $item['product_price'] * $item['product_quantity'];
        }

        return view('client.cart.cart', compact('cartProducts', 'totalPrice'));
    }

    public function addToCart(Request $request)
    {

        $product_id = $request->input('product_id');
        $product_size = $request->input('product_size');
        $product_quantity = $request->input('product_quantity');
        $product_color = $request->input('product_color');

        $product = Product::find($product_id);

        // Kiểm tra xem người dùng đã đăng nhập chưa
        $user = Auth::user();

        if ($user) {
            // Nếu người dùng đã đăng nhập, kiểm tra xem có giỏ hàng của họ không
            $cart = Cart::where('user_id', $user->id)->first();

            if (!$cart) {
                // Nếu chưa có, tạo giỏ hàng mới
                $cart = new Cart();
                $cart->user_id = $user->id;
                $cart->save();
            }

            $cartProduct = new CartProduct();
            $cartProduct->cart_id = $cart->id;
            $cartProduct->product_id = $product_id;
            $cartProduct->product_name = $product->name;
            $cartProduct->product_size = $product_size;
            $cartProduct->product_quantity = $product_quantity;
            $cartProduct->product_color = $product_color;
            $cartProduct->product_price = $product->price;
            $cartProduct->save();
        } else {
            // Nếu người dùng chưa đăng nhập, có thể tạo một giỏ hàng tạm thời
            $sessionCart = Session::get('cart', []);
            if (!is_array($sessionCart)) {
                // Nếu $sessionCart không phải là một mảng, tạo một mảng mới
                $sessionCart = [];
            }
            $sessionCart[] = [
                'product_id' => $product_id,
                'product_name' => $product->name,
                'product_size' => $product_size,
                'product_quantity' => $product_quantity,
                'product_color' => $product_color,
                'product_price' => $product->price,
            ];

            // Lưu giỏ hàng vào Session
            Session::put('cart', $sessionCart);


            $cartProduct = new CartProduct();
            $cartProduct->product_id = $product_id;
            $cartProduct->product_name = $product->name;
            $cartProduct->product_size = $product_size;
            $cartProduct->product_quantity = $product_quantity;
            $cartProduct->product_color = $product_color;
            $cartProduct->product_price = $product->price;
            $cartProduct->save();
        }

        return redirect()->back()->with('message', 'Product added to cart successfully');
    }

    public function removeFromCart(Request $request, $id)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        $user = Auth::user();

        if ($user) {
            // Nếu người dùng đã đăng nhập, kiểm tra xem có giỏ hàng của họ không
            $cart = Cart::where('user_id', $user->id)->first();

            if ($cart) {
                // Tìm sản phẩm trong giỏ hàng của người dùng đã đăng nhập
                $cartProduct = CartProduct::where('cart_id', $cart->id)
                    ->where('product_id', $id)
                    ->first();

                if ($cartProduct) {
                    // Xóa sản phẩm khỏi giỏ hàng của người dùng
                    $cartProduct->delete();
                }
            }
        } else {
            // Nếu người dùng chưa đăng nhập, kiểm tra xem có giỏ hàng Session không
            $sessionCart = Session::get('cart', []);

            if (!empty($sessionCart)) {
                // Tìm sản phẩm trong giỏ hàng Session và xóa nó
                foreach ($sessionCart as $key => $item) {
                    if ($item['product_id'] == $id) {
                        unset($sessionCart[$key]);
                    }
                }

                // Cập nhật giỏ hàng Session sau khi xóa sản phẩm
                Session::put('cart', $sessionCart);
            }
        }

        // Quay trở lại trang giỏ hàng sau khi xóa sản phẩm
        return redirect()->route('client.cart.show')->with('message', 'The product has been successfully removed from the cart.');
    }


    public function updateCart(Request $request)
    {
        $id = $request->input('id');
        $newQuantity = $request->input('quantity');

        // Tìm sản phẩm trong giỏ hàng
        $cartProduct = CartProduct::find($id);

        if (!$cartProduct) {
            return response()->json(['error' => 'Product not found in cart.'], 404);
        }

        // Kiểm tra số lượng mới có hợp lệ không
        if ($newQuantity <= 0) {
            return response()->json(['error' => 'Quantity must be greater than 0.'], 400);
        }

        // Cập nhật số lượng sản phẩm trong giỏ hàng
        $cartProduct->quantity = $newQuantity;
        $cartProduct->save();

        return response()->json(['message' => 'Cart updated successfully.']);
    }
    public function getCartAfterLogin()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $cart = Cart::where('user_id', $user->id)->first();

            // Truy vấn các sản phẩm trong giỏ hàng
            $cartProducts = $cart->cartProducts; // Đây là mối quan hệ bạn đã định nghĩa trong model Cart

            // Tính tổng giá trị giỏ hàng
            $totalPrice = $cartProducts->sum(function ($cartProduct) {
                return $cartProduct->product_price * $cartProduct->product_quantity;
            });

            // Trả về view và truyền dữ liệu giỏ hàng tới view
            return view('client.cart.cart', compact('cartProducts', 'totalPrice'));
        }
    }

// Đăng xuất người dùng
    public function logout(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Lấy giỏ hàng hiện tại của user (nếu có)
            $userCart = Cart::where('user_id', $user->id)->first();

            // Lấy giỏ hàng tạm thời trong Session (nếu có)
            $sessionCart = Session::get('cart', []);

            // Nếu có giỏ hàng trong Session và giỏ hàng của user
            if (!empty($sessionCart) && $userCart) {
                // Hợp nhất giỏ hàng tạm thời vào giỏ hàng của user
                foreach ($sessionCart as $item) {
                    $cartProduct = new CartProduct([
                        'product_id' => $item['product_id'],
                        'product_size' => $item['product_size'],
                        'product_quantity' => $item['product_quantity'],
                        'product_color' => $item['product_color'],
                        'product_price' => $item['product_price'],
                    ]);

                    $userCart->cartProducts()->save($cartProduct);
                }

                // Xóa giỏ hàng tạm thời trong Session sau khi hợp nhất
                Session::forget('cart');
            }

            // Đăng xuất người dùng
            Auth::guard('web')->logout();
        }

        return redirect('/login');
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
