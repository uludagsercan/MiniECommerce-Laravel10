@extends('layouts.admin-layout')
@section("title","Create Category")

@section("content")
  <form method="post" action="{{route('admin.category.store')}}" >
      @csrf
     <div class="container-fluid">
         <div class="card card-info">
             <div class="card-header">
                 <h3 class="card-title">Category</h3>
             </div>
             <div class="card-body">
                 <div class="input-group mb-3">

                     <input type="text" class="form-control" placeholder="Category Name" name="name">
                     @error('name')
                     <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
                 </div>
                 <div class="input-group mb-3">

                     <input type="text" class="form-control" placeholder="Category Description" name="description">
                     @error('description')
                     <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
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


