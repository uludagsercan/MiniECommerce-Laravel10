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
                <h3 class="card-title">New Message</h3>
            </div>
            <!-- /.card-header -->
            <form method="post" action="{{ route('admin.mailbox.sendMail') }}">
              @csrf
                <div class="card-body">
                    <div class="form-group">
                        <select class="form-control" name="to">
                          <option value="">To:</option>
                            @foreach ($users as $user)
                            <option  value="{{ $user->email }}">{{ $user->email }}</option>
                            @endforeach
                        </select>
                    

                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Subject:" name="subject">
                    </div>
                    <div class="form-group">
                        <textarea id="compose-textarea" class="form-control" style="height: 300px" name="body">
       
                  </textarea>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                    </div>
                </div>
            </form>

            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </div>
@endsection
