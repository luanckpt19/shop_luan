@extends('layouts.admin')

@section('title')
    <title>Trang Chủ</title>

@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header' , ['name' => 'permissions', 'key' => 'Add'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">


                    <div class="col-md-12">
                        <form action="{{ route('admin.permissions.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label>Chọn Tên Module</label>
                                <select class="form-control" name="module_parent">
                                    <option value="">Chọn Tên Module</option>
                                    @foreach(config('permissions.table_module') as $moduleItem)
                                    <option value="{{$moduleItem}}">{{$moduleItem }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    @foreach(config('permissions.module_childrent') as $moduleItemChildrent)
                                    <div class="col-md-3">
                                        <label >
                                            <input type="checkbox" value="{{$moduleItemChildrent}}" name="module_childrent[]">
                                            {{$moduleItemChildrent}}
                                        </label>
                                    </div>
                                    @endforeach

                                </div>
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


