@extends('admin-components.mailbox.layouts.mailbox-layout')
@if ($unreadMessageCount > 0)
    @section('unreadMessageClass', 'danger')

    @section('unreadMessageCount', $unreadMessageCount)
@else
    @section('unreadMessageClass', 'success')

    @section('unreadMessageCount', $unreadMessageCount)
@endif

@section('mailbox-content')
<div class="col-md-9">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title">Read Mail</h3>

        <div class="card-tools">
          <a href="#" class="btn btn-tool" title="Previous"><i class="fas fa-chevron-left"></i></a>
          <a href="#" class="btn btn-tool" title="Next"><i class="fas fa-chevron-right"></i></a>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="mailbox-read-info">
          <h5>{{$mailbox->subject}}</h5>
          <h6>From: {{$mailbox->from}}
            <span class="mailbox-read-time float-right">{{$mailbox->updated_at}}</span></h6>
        </div>
        <!-- /.mailbox-read-info -->
       
        <!-- /.mailbox-controls -->
        <div class="mailbox-read-message">
          <p>{{$mailbox->body}}</p>
        </div>
        <!-- /.mailbox-read-message -->
      </div>
      <!-- /.card-body -->
    
      <!-- /.card-footer -->
      <div class="card-footer">
        <div class="float-right">
        <a href="{{route("admin.mailbox.deleteMail",["id"=>$mailbox->id])}}" class="btn btn-default"><i class="far fa-trash-alt"></i> Delete</a>
      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->
  </div>

@endsection