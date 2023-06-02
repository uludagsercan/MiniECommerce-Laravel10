@extends('layouts.admin-layout')
@section("title","Create User")
@section("content")
    <form method="post" action="{{route('admin.user.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">User</h3>
                </div>
                <div class="card-body">



                        <div class="form-group mb-3">
                            <label for="cName" >Role</label>
                            <select class="form-control" name="category_id">
                                <option value="">Role</option>
                                @foreach($roles as $role) <option value="{{$role->id}}">{{$role->name}}</option>@endforeach
                            </select>
                        </div>

                    <div class="form-group mb-3">
                        <label for="cName" >User Name</label>
                        <input id="cName" type="text" class="form-control"   name="name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="cName" >Email</label>
                        <input id="cName" type="text" class="form-control"  name="email">
                    </div>

                    <div class="form-group mb-3">
                        <label for="cPrice" >Password</label>
                        <input id="cPrice" type="password" class="form-control"  name="password">
                    </div>
               
                
                    <div class="input-group mb-3">

                        <button type="submit" class="btn btn-secondary">Create</button>
                    </div>

                    <!-- /input-group -->
                </div>
                <!-- /.card-body -->
            </div>
        </div>

    </form>

@endsection



