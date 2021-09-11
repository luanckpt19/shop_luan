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

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'order', 'key' => 'List'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                            <a href="{{route('admin.orders.create')}}" class="btn btn-success float-right m-2">ADD</a>

                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên Khách Hàng</th>
                                <th scope="col">SĐT </th>
                                <th scope="col">Email</th>
                                <th scope="col">Trạng Thái</th>
                                <th scope="col">Sản Phẩm</th>
                                <th scope="col">Tổng Tiền</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(isset($orders) && !empty($orders))
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>

                                        <td>{{ $order->customer_name }}</td>
                                        <td>{{ $order->customer_phone }}</td>
                                        <td>{{ $order->customer_email }}</td>

                                        <td>{{ $order_status_defined[$order->order_status] }}</td>

                                        <td>
                                            {{ $order->total_product }}
                                        </td>
                                        <td>{{ number_format($order->total_price) }}</td>
                                        <td>
                                            <a href="{{route('admin.orders.edit', ['id'=>$order->id])}}"
                                               class="btn btn-default"> Edit</a>

                                            <a href=""
                                               data-url="{{route('admin.orders.delete', ['id'=>$order->id])}}"
                                               class="btn btn-danger action_delete"> Delete</a>

                                        </td>

                                @endforeach
                                @else
                                    Chưa có bản ghi nào trong bảng này
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">

                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

