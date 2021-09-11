@extends('layouts.admin')

@section('title')
    <title>Trang Chủ</title>

@endsection
@section('css')
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>

@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header' , ['name' => 'User', 'key' => 'Edit'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">


                    <div class="col-md-6">
                        <form action=" {{ route('admin.users.update', ['id' => $user->id]) }} " method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên User</label>
                                <input type="text" class="form-control " name="name" placeholder="Nhập Tên " value="{{ $user->name }}">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control " name="email" placeholder="Nhập Email " value="{{ $user->email }}">
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control " name="password" placeholder="Nhập Password ">
                            </div>

                            <div class="form-group">
                                <label>Chọn vai trò</label>
                            <select  name="role_id" class="form-control select2_init " multiple>
                                <option value=""></option>
                                @foreach($roles as $role)
                                    <option
                                        {{ $rolesOfUser->contains('id',$role->id) ? 'selected' : ''}}
                                        value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach


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

@section('js')
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script>
        $('.select2_init').select2({
            'placeholder':'Chọn vai trò'
        })
    </script>
@endsection

