<form action="{{route('admin.mailbox.sendMail')}}" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="form-group">
            @csrf
            <input name="to" class="form-control">
            <input name="from" class="form-control">
            <input name="subject" class="form-control">
            <input name="description" class="form-control">
            <button type="submit">qqq</button>
        </div>
    </div>

</form>