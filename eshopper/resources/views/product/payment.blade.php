@extends('layouts.master')

@section('title')
    <title>Home | E-Shopper</title>
@endsection

@section('css')
    <link href=" {{ asset('home/home.css') }}" rel="stylesheet">
    <link href=" {{ asset('cart/cart.css') }}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{asset('cart/add_to_cart.js')}}"></script>
@endsection

@section('content')
    <section class="checkout spad">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div>
            <div class="checkout__form">
                <h4>Thông tin đơn hàng</h4>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form name="order" method="post" action="{{ url("/payment/checkout") }}">

                    @csrf

                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Họ tên<span>*</span></p>
                                        <input type="text" name="customer_name">
                                    </div>
                                </div>
                            </div>

                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input type="text" name="customer_address" placeholder="Street Address"
                                       class="checkout__input__add">
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>SDT<span>*</span></p>
                                        <input type="text" name="customer_phone">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="customer_email">
                                    </div>
                                </div>
                            </div>

                            <div class="checkout__input">
                                <p>Ghi chút đơn hàng<span>*</span></p>
                                <input type="text" name="order_note"
                                       placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Đơn hàng của bạn</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach($carts as $id => $cartItem)
                                        @php $total += $cartItem['price'] * $cartItem['quantity'] @endphp
                                        <li>{{ $cartItem['name'] }} <span>{{ number_format($cartItem['price'] * $cartItem['quantity']) }} VNĐ</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">Tổng tiền <span>{{ number_format($total)  }} VNĐ</span></div>
                                <div class="checkout__order__total">Thanh toán <span>{{ number_format($total)  }} VNĐ</span></div>

                                <button type="submit" class="btn btn-primary">ĐẶT HÀNG</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection









