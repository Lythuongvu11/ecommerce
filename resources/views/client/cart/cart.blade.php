@extends('client.layouts.app')
@section('title','Cart')
@section('content')
    @if (session('message'))
        <h2 class="" style="text-align: center; width:100%; color:red"> {{ session('message') }}</h2>
    @endif
    <div class="container-fluid">
        <h2>Your Cart</h2>
        @if(count($cartProducts) > 0)
        <table class="table">
            <thead>
            <tr>
                <th>Product</th>
                <th>Size</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cartProducts as $cartProduct)
                <tr>
                    <td>
                        <a href="{{ route('product.show', ['id' => $cartProduct['product_id']]) }}">
                            {{ $cartProduct['product_name'] }}
                        </a>
                    </td>
                    <td>{{ $cartProduct['product_size'] }}</td>
                    <td>${{ $cartProduct['product_price'] }}</td>
                    <td>{{ $cartProduct['product_quantity'] }}</td>
                    <td>${{ $cartProduct['product_price'] * $cartProduct['product_quantity'] }}</td>
                    <td>
                        <a href="{{ route('client.cart.remove', ['id' => $cartProduct['product_id']]) }}" class="btn btn-danger btn-sm">Remove</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-right">
            <h4>Total: ${{ $totalPrice }}</h4>
        </div>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
    <script>
        // Xử lí khi thay đổi số lượng sản phẩm trong giỏ hàng
        $('input[type="number"]').on('change', function() {
            const productId = $(this).data('id');
            const newQuantity = $(this).val();
            $.ajax({
                type: 'POST',
                url: '{{ route('update-cart') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: productId,
                    quantity: newQuantity
                },
                success: function(data) {
                    // Cập nhật lại tổng giá trị và hiển thị nếu cần
                }
            });
        });
    </script>
@endsection

