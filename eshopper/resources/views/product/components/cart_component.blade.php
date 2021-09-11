<section id="cart_items" >
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>

        </div>

        <div class="table-responsive cart_info" >
            <table class="table table-condensed update_cart_url">
                <thead>
                <tr class="cart_menu">
                    <td class="image" style="text-align: center">Item</td>
                    <td class="description" style="text-align: center">Name</td>
                    <td class="price" style="text-align: center">Price</td>
                    <td class="quantity" style="text-align: center">Quantity</td>
                    <td class="total" style="text-align: center">Total</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                @php
                    $total =0;
                @endphp
                @foreach($carts as $id => $cartItem )
                    @php
                        $total += $cartItem['price'] * $cartItem['quantity']
                    @endphp
                    <tr>
                        <td class="cart_product">
                            <a href="" ><img style="width: 200px; height: 200px;object-fit: contain" src="{{config('app.base_url'). $cartItem['image']}}" alt=""></a>
                        </td>
                        <td class="cart_description" style="text-align: center">
                            <h4><a href="">{{ $cartItem['name'] }}</a></h4>
                        </td>
                        <td class="cart_price">
                            <p>{{ number_format($cartItem['price']) }} VNĐ</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_down" href="" style="text-decoration: none"> - </a>
                                <input class="cart_quantity_input quantity" type="text" name="quantity" value="{{ $cartItem['quantity'] }}" autocomplete="off" size="2">
                                <a class="cart_quantity_up" href="" style="text-decoration: none"> + </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{ number_format($cartItem['price'] * $cartItem['quantity']) }} VNĐ</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete cart_update_times" data-id="{{ $id }}" href=""  data-url="{{ route('updateCart') }}"><i class="fa fa-check" style="margin:-1px"></i></a>
                            <a class="cart_quantity_delete cart_delete_times" data-id="{{ $id }}" href="" data-url="{{ route('deleteCart') }}"><i class="fa fa-times"></i></a>

                        </td>
                    </tr>

                @endforeach
                <tr>
                    <td colspan="4">&nbsp;</td>
                    <td colspan="2">
                        <table class="table table-condensed total-result">
                            <tr>
                                <td>Total</td>
                                <td><span>{{ number_format($total)  }} VNĐ</span></td>
                            </tr>
                        </table>
                        <a href="{{ route('payment') }}" class="btn btn-primary">PROCEED TO CHECKOUT</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
