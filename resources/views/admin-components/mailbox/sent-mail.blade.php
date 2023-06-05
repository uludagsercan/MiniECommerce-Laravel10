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
                <h3 class="card-title">Sent Mail</h3>


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

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mailboxes as $mailbox)
                                <tr>
                                 
                                    <td class="mailbox-name"><a href="{{ route('admin.mailbox.readMailbox', ['id' => $mailbox->id]) }}">{{ $mailbox->user->name }}</a></td>
                                    <td class="mailbox-subject"><a href="{{ route('admin.mailbox.readMailbox', ['id' => $mailbox->id]) }}"><b>{{ $mailbox->subject }}</b>-{{ $mailbox->body }}</a>
                                    </td>
                                    <td class="mailbox-date"><a href="{{ route('admin.mailbox.readMailbox', ['id' => $mailbox->id]) }}">{{ $mailbox->created_at }}</a></td>
                               
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
