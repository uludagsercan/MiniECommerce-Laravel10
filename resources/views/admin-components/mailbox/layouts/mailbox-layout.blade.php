@extends('layouts.admin-layout')
@section('title',"Mailbox")
@section("content")
<section class="content">
    <div class="row">
       
        <div class="col-md-3">
            <a href="{{route('admin.mailbox.create')}}" class="btn btn-primary btn-block mb-3">New Mail</a>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Mailbox</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item active">
                            <a href="{{route('admin.mailbox.index')}}" class="nav-link">
                                <i class="fas fa-inbox"></i> Inbox
                              
                                <span class="badge bg-@yield("unreadMessageClass") float-right"> @yield("unreadMessageCount")</span>
                              
                              
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.mailbox.sentMailboxes')}}" class="nav-link">
                                <i class="far fa-envelope"></i> Sent
                            </a>
                        </li>
                      
                   
                        {{-- <li class="nav-item">
                            <a href="{{route('admin.mailbox.trashMailboxes')}}" class="nav-link">
                                <i class="far fa-trash-alt"></i> Trash
                            </a>
                        </li> --}}
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        
            <!-- /.card -->
        </div>

        @yield("mailbox-content")
    </div>
</section>
@endsection
