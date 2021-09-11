@extends('layouts.master')

@section('title')
    <title>Home | E-Shopper</title>
@endsection

@section('css')
    <link href=" {{ asset('home/home.css') }}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{asset('cart/add_to_cart.js')}}"></script>
@endsection

@section('content')
    <div class="cart_wrapper">
        @include('product.components.cart_component')
    </div>
@endsection









