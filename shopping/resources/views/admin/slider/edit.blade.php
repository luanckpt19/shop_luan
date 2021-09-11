@extends('layouts.admin')

@section('title')
    <title>Trang Chủ</title>

@endsection
@section('css')
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admins/slider/add/add.css') }}" rel="stylesheet" />
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header' , ['name' => 'Slider', 'key' => 'Edit'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">


                    <div class="col-md-6">
                        <form action="{{ route('admin.slider.update' , ['id'=> $slider->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên Slider</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nhập Tên " value="{{$slider->name}}">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Mô Tả Slider</label>
                                <textarea  class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Nhập mô tả" >
                                    {{$slider->description}}
                                </textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input type="file" class="form-control-file @error('image_path') is-invalid @enderror" name="image_path">
                                <div class="col-md-4">
                                    <div class="row">
                                        <img class="image_slider" src="{{$slider->image_path}}" alt="">
                                    </div>
                                </div>
                                @error('image_path')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>


                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{ asset('Admins/product/add/add.js') }}"></script>
@endsection

