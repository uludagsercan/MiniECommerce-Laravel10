@extends('admin-components.mailbox.layouts.mailbox-layout')
@if ($unreadMessageCount > 0)
    @section('unreadMessageClass', 'danger')

    @section('unreadMessageCount', $unreadMessageCount)
@else
    @section('unreadMessageClass', 'success')

    @section('unreadMessageCount', $unreadMessageCount)
@endif

@section('mailbox-content')


    <!-- /.col -->
    <div class="col-md-9">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Trash Mail</h3>


                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">

                <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Message</th>
                                <th>Created Date</th>
                                <th>Delete</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mailboxes as $mailbox)
                                <tr>
                                  
                                    <td class="mailbox-name">{{ $mailbox->user->name }}</td>
                                    <td class="mailbox-subject"><b>{{ $mailbox->subject }}</b>-{{ $mailbox->body }}
                                    </td>
                                    <td class="mailbox-date">{{ $mailbox->created_at }}</td>
                                    <td>

                                        <a href="{{ route('admin.mailbox.deleteMail', ['id' => $mailbox->id]) }}">
                                            <i class="far fa-trash-alt"></i> </a>
                                    </td>

                                   
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <!-- /.table -->
                </div>
                <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
         
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->

    <!-- /.row -->

@endsection
