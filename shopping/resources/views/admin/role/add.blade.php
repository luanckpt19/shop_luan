@extends('layouts.admin')

@section('title')
    <title>Trang Chủ</title>

@endsection
@section('css')
    <link href="{{ asset('Admins/role/add/add.css') }}" rel="stylesheet"/>
@endsection
@section('js')
 <script src=" {{ asset('Admins/role/add/add.js') }}">
 </script>
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header' , ['name' => 'Roles', 'key' => 'Add'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{ route('admin.roles.store') }}" method="post" enctype="multipart/form-data" style="width: 100%">

                        <div class="col-md-12">

                            @csrf
                            <div class="form-group">
                                <label>Tên Vai Trò</label>
                                <input type="text" class="form-control " name="name" placeholder="Nhập Tên Vai Trò"
                                       value="{{old('name')}}">

                            </div>

                            <div class="form-group">
                                <label>Mô Tả Vai Trò</label>
                                <textarea class="form-control " name="display_name" placeholder="Nhập mô tả">
                                    {{old('display_name')}}
                                </textarea>

                            </div>


                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <labe>
                                        <input type="checkbox" class="checkall">
                                        checkall
                                    </labe>
                                </div>

                                @foreach($permissionsParent as $permissionsParentItem)
                                    <div class="card border-primary mb-3 col-md-12">
                                        <div class="card-header">
                                            <label>
                                                <input type="checkbox" value="" class="checkbox_wrapper">
                                            </label>
                                            Module {{$permissionsParentItem->name}}
                                        </div>

                                        <div class="row">
                                            @foreach($permissionsParentItem-> permissionsChildrent as $permissionsChildrentItem)
                                                <div class="card-body text-primary col-md-3">
                                                    <h5 class="card-title">
                                                        <label>
                                                            <input type="checkbox" name="permission_id[]"
                                                                   class="checkbox_childrent "
                                                                   value="{{$permissionsChildrentItem->id}}">
                                                        </label>
                                                        {{$permissionsChildrentItem->name}}
                                                    </h5>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>

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

