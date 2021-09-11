@extends('layouts.admin')

@section('title')
    <title>Add Product</title>
@endsection

@section('css')
   <link rel="stylesheet" href="{{ asset('Admins/product/index/list.css') }}">
@endsection
@section('js')
    <script src="{{ asset('vendor/sweetAlert2/sweetalert2@11.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admins/main.js') }}"></script>
@endsection

@section('header')
    @include('partials.header-product')
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'product', 'key' => 'List'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @can('product-add')
                        <a href="{{route('admin.product.create')}}" class="btn btn-success float-right m-2">ADD</a>
                        @endcan
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên Sản Phẩm</th>
                                <th scope="col">Giá </th>
                                <th scope="col">Images</th>
                                <th scope="col">Danh Mục</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($products as $productItem)

                                <tr>
                                    <th scope="row">{{$productItem->id}} </th>
                                    <td>{{ $productItem->name }}</td>
                                    <td>{{ number_format($productItem->price)}}</td>
                                    <td>
                                        <img class="product_image_150_100" src=" {{ $productItem->feature_image_path }} " alt="">
                                    </td>
                                    <td>{{ optional($productItem->category)->name}}</td>
                                    <td>
                                        <a href="{{ route('admin.product.edit', ['id'=>$productItem->id]) }}"
                                           class="btn btn-default"> Edit</a>
                                            @can('product-delete')
                                        <a href=""
                                           data-url="{{ route('admin.product.delete', ['id'=>$productItem->id]) }}"
                                           class="btn btn-danger action_delete"> Delete</a>
                                            @endcan
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $products->links() }}
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

