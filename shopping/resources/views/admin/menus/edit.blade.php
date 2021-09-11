@extends('layouts.admin')

@section('title')
    <title>Trang Chủ</title>

@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header' , ['name' => 'menus', 'key' => 'Edit'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">


                    <div class="col-md-6">
                        <form action="{{ route('admin.menus.update', ['id'=>$menuFollowIdEdit->id]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên Menu</label>
                                <input type="text" class="form-control" name="name" placeholder="Nhập Tên Menu" value="{{ $menuFollowIdEdit->name }}">
                            </div>
                            <div class="form-group">
                                <label>Chọn Menu Cha</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">Chọn Menu Cha</option>
                                    {!! $optionSelect !!}
                                </select>
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


