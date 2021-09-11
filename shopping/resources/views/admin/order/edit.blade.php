@extends('layouts.admin')

@section('title')
    <title>Order</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('Admins/product/index/list.css') }}">
@endsection
@section('js')
    <script src="{{ asset('vendor/sweetAlert2/sweetalert2@11.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admins/main.js') }}"></script>
@endsection

@section('header')

@endsection

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'order', 'key' => 'Edit'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <h1>Cập nhật đơn hàng</h1>
                    <div class="col-md-12">
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

                        <form name="orders" action="{{ route('admin.orders.update', ['id' =>$order ->id]) }} }}" method="post" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group">
                                <label for="customer_name">Tên khách hàng:</label>
                                <input type="text" name="customer_name" class="form-control" id="customer_name" value="{{ $order->customer_name }}">
                            </div>

                            <div class="form-group">
                                <label for="customer_email">Email:</label>
                                <input type="text" name="customer_email" class="form-control" id="customer_email" value="{{ $order->customer_email }}">
                            </div>

                            <div class="form-group">
                                <label for="customer_phone">Số điện thoại:</label>
                                <input type="text" name="customer_phone" class="form-control" id="customer_phone" value="{{ $order->customer_phone }}">
                            </div>


                            <div class="form-group">
                                <label for="order_status">Trạng thái đơn hàng:</label>
                                <select name="order_status" class="form-control" style="width: 250px">
                                    <option value="1" {{ $order->order_status == 1 ? "selected" : "" }}>Đang chờ xác nhận</option>
                                    <option value="2" {{ $order->order_status == 2 ? "selected" : "" }}>Đã xác nhận</option>
                                    <option value="3" {{ $order->order_status == 3 ? "selected" : "" }}>Đang vận chuyển</option>
                                    <option value="4" {{ $order->order_status == 4 ? "selected" : "" }}>Hoàn tất</option>
                                    <option value="5" {{ $order->order_status == 5 ? "selected" : "" }}>Đơn hủy</option>
                                    <option value="6" {{ $order->order_status == 6 ? "selected" : "" }}>Đã hoàn tiền ( hủy đơn )</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="customer_address">Địa chỉ:</label>
                                <textarea name="customer_address" class="form-control" rows="3" id="customer_address">{{ $order->customer_address }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="customer_phone">Sản phẩm trong đơn hàng:</label>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Id sản phẩm</th>
                                        <th>ảnh đại diện</th>
                                        <th>tên sản phẩm</th>
                                        <th>số lượng</th>
                                        <th>giá tiền</th>
                                        <th>tổng giá</th>
                                    </tr>
                                    </thead>
                                    <tbody id="list-cart-product">
                                    @foreach($productOrders as $productOrder)
                                        <tr>
                                            <td> {{ $productOrder['id'] }} </td>
                                            <td>
                                                <img src="{{ $productOrder["image"] }}" alt="" style="width: 200px; height: auto" />
                                            </td>
                                            <td>{{ $productOrder["name"] }}</td>
                                            <td>
                                                {{$productOrder["quantity"]}}
                                            </td>
                                            <td class="product_price">
                                                {{ number_format($productOrder["price"]) }} VNĐ
                                            </td>
                                            <td class="product_price_total">

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div style="font-weight: bold">Tổng tiền thanh toán: <strong id="payment-price">{{ number_format($order->total_price )}} VNĐ</strong></div>
                            </div>

                            <div class="form-group">
                                <label for="order_note">Ghi chú:</label>
                                <textarea name="order_note" class="form-control" rows="3" id="order_note">{{ $order->order_note }}</textarea>
                            </div>



                            <button type="submit" class="btn btn-info">Cập nhật đơn hàng</button>
                        </form>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>



@endsection





