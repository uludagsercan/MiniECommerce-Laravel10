

@extends('layouts.admin-layout')
@section("title","Users")
@section("content")
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12" style="transform: translateY(341.6px);">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="/assets/admin/dist/img/avatar.png"
                     alt="User profile picture">
              </div>
              <h2 class="profile-username text-center">{{$user->email}}</h2>

              <h3 class="profile-username text-center">{{$user->name}}</h3>

              @if ($user->role)
              <p class="text-muted text-center">{{ $user->role->name}}</p>
                  
              @else
              <p class="text-muted text-center"><a href="{{route('admin.user.edit',['id'=>$user->id])}}">Create Role</a></p>
                  
              @endif

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

       
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>

  @endsection