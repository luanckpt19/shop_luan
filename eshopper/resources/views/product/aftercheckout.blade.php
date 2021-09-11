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

            <div class="checkout__form">
                <h4>Thông tin</h4>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

            </div>
        </div>
    </section>
@endsection









