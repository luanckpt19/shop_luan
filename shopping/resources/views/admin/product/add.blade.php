@extends('layouts.admin')

@section('title')
    <title>ADD Product</title>
@endsection

@section('css')
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admins/product/add/add.css') }}" rel="stylesheet" />
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header' , ['name' => 'product', 'key' => 'Add'])
    <!-- /.content-header -->
        <div class="col-md-12">
{{--            @if ($errors->any())--}}
{{--                <div class="alert alert-danger">--}}
{{--                    <ul>--}}
{{--                        @foreach ($errors->all() as $error)--}}
{{--                            <li>{{ $error }}</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            @endif--}}
        </div>
        <!-- Main content -->
        <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">


                        <div class="col-md-6">

                            @csrf
                            <div class="form-group">
                                <label>Tên Sản Phẩm</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nhập Tên Sản Phẩm" value="{{old('name')}}">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Giá Sản Phẩm</label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Nhập Giá Sản Phẩm" value="{{old('price')}}">
                                @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Ảnh Sản Phẩm</label>
                                <input type="file" class="form-control-file" name="feature_image_path">
                            </div>

                            <div class="form-group">
                                <label>Ảnh Chi Tiết</label>
                                <input type="file" multiple class="form-control-file" name="image_path[]">

                            </div>

                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control select2_init @error('category_id') is-invalid @enderror" name="category_id" >
                                    <option value="">Chọn danh mục</option>
                                    {!! $htmlOption !!}
                                </select>
                                @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Nhập Tags cho sản phẩm</label>
                                <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">

                                </select>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="form-control tinymce_editor_init @error('contents') is-invalid @enderror" name="contents" rows="12">
                                    {{old('contents')}}
                                </textarea>
                                @error('contents')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>


                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
        </form>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{ asset('Admins/product/add/add.js') }}"></script>
@endsection

