@extends('layouts.admin')

@section('title')
    <title>Trang Chủ</title>

@endsection
@section('css')
    <link href="{{ asset('admins/slider/index/index.css') }}" rel="stylesheet" />
@endsection
@section('js')
    <script src="{{ asset('vendor/sweetAlert2/sweetalert2@11.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admins/main.js') }}"></script>
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Slider', 'key' => 'Add'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href=" {{ route('admin.slider.create') }}" class="btn btn-success float-right m-2">ADD</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên Slider</th>
                                <th scope="col">Description</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($sliders as $slider)

                                <tr>
                                    <th scope="row">{{ $slider->id }}</th>
                                    <td>{{ $slider->name }}</td>
                                    <td>{{ $slider->description }}</td>
                                    <td>
                                        <img class="image_slider_150_100" src="{{ $slider->image_path }}" alt="">
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.slider.edit', ['id' => $slider->id]) }}" class="btn btn-default"> Edit</a>
                                        <a href=""
                                           data-url="{{ route('admin.slider.delete', ['id' => $slider->id]) }}"
                                           class="btn btn-danger action_delete"> Delete</a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $sliders ->links() }}
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


