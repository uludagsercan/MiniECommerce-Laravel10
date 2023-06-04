@extends('layouts.admin-layout')
@section('title', 'Update Announcement')
@section('content')
    @if ($announcement)
        <form method="post" action="{{ route('admin.announcement.update') }}">
            @csrf

            <div class="container-fluid">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Announcement</h3>
                    </div>
                    <div class="card-body">

                        <input type="hidden" name="id" value="{{ $announcement->id }}">
                        <div class="form-group mb-3">
                            <label for="cName">Product Name</label>
                            <select class="form-control" name="product_id">
                                <option value="">Product Name</option>
                                @foreach ($products as $product)
                                    @if ($product->id == $announcement->product->id)
                                        <option value="{{ $product->id }}" selected>{{ $product->name }}</option>
                                    @else
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('product_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="cName">Announcement Title</label>
                            <input id="cName" type="text" class="form-control" name="announcement_title"
                                value="{{ $announcement->announcement_title }}">
                            @error('announcement_title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="cName">Announcement Description</label>
                            <input id="cName" type="text" class="form-control" name="announcement_description"
                                value="{{ $announcement->announcement_description }}">
                            @error('announcement_description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input-group mb-3">

                            <button type="submit" class="btn btn-secondary">Update</button>
                        </div>

                        <!-- /input-group -->
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

        </form>
    @else
        Announcement Bulunamadı
    @endif

@endsection
