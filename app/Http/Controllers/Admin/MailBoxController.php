<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mailbox;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MailBoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $getUser = Auth::user();
        $mailboxes = Mailbox::with("user")->where("user_id", "!=", $getUser["id"])->where("to", $getUser["email"])->where(function ($query) {
            $query->where("mail_types", "=", "read")->orWhere("mail_types", "=", "unread");
        })->get();
        $unreadMessageCount = Mailbox::with("user")->where("user_id", "!=", $getUser["id"])->where("to", $getUser["email"])->where("mail_types", "unread")->count();
        return view("admin-components.mailbox.index", ["mailboxes" => $mailboxes, 'unreadMessageCount' => $unreadMessageCount]);
    }
    public function sentMailboxes()
    {
        $getUser = Auth::user();
        $unreadMessageCount = Mailbox::with("user")->where("user_id", "!=", $getUser["id"])->where("to", $getUser["email"])->where("mail_types", "unread")->count();
        $mailboxes = Mailbox::with("user")->where("from", $getUser->email)->where(function ($query) {
            $query->where("mail_types", "=", "read")->orWhere("mail_types", "=", "unread");
        })->get();
        return view("admin-components.mailbox.sent-mail", ["mailboxes" => $mailboxes, 'unreadMessageCount' => $unreadMessageCount]);
    }
    public function trashMailboxes()
    {
        $getUser = Auth::user();
        $mailboxes = Mailbox::with("user")->where(function ($query) {
            $getUser = Auth::user();
            $query->where("to", $getUser->email)->orWhere("from", $getUser->email);
        })->where(function ($query) {
            $query->where("mail_types", "read_and_trash")->orWhere("mail_types", "unread_and_trash");
        })->get();
        $unreadMessageCount = Mailbox::with("user")->where("user_id", "!=", $getUser["id"])->where("to", $getUser["email"])->where("mail_types", "unread")->count();

        return view("admin-components.mailbox.trash-mail", ["mailboxes" => $mailboxes, 'unreadMessageCount' => $unreadMessageCount]);
    }

    public function deleteMail($id)
    {
        $mailbox = Mailbox::with("user")->find($id);
        if ($mailbox->mail_types == "read_and_trash" || $mailbox->mail_types == "unread_and_trash") {
            $mailbox->delete();
            return redirect()->back();
        } else {
            if ($mailbox->mail_types == "read") {
                $mailbox->mail_types = "read_and_trash";
            }
            if ($mailbox->mail_types == "unread") {
                $mailbox->mail_types = "unread_and_trash";
            }
        }
        DB::table("mailboxes")->where("id", $id)->update([
            "mail_types" => $mailbox->mail_types
        ]);
        return redirect()->back();
    }
    public function readMailbox($id)
    {
        $getUser = Auth::user();
        $mailbox = Mailbox::with("user")->find($id);
        $mailbox["mail_types"] = config('constants.mail_types.read');
        DB::table("mailboxes")->where("id", $id)->update([
            "mail_types" => config('constants.mail_types.read')
        ]);
        $unreadMessageCount = Mailbox::with("user")->where("user_id", "!=", $getUser["id"])->where("to", $getUser["email"])->where("mail_types", "unread")->count();

        return view("admin-components.mailbox.view-mail", ["mailbox" => $mailbox, 'unreadMessageCount' => $unreadMessageCount]);
    }

    


    public function sendMail(Request $request)
    {
        $mail = new Mailbox();
        $data = $request->all();
        $mail->fill($data);
        $mail->from = Auth::getUser()->email;
        $mail->user_id = Auth::getUser()->id;
        $mail->save();
        return redirect("admin/mailbox");
        // $user->name="Sercan";
        // $user->email="sercan@hotmail.com";
        // $user->password="123-+Asd!!";
        // $user->factory()->create(['name' => "Sercan", 'email' => "sercan@hotmail.com", "password" => "123-+Asd!!"]);
        // $message = new Message();
        // $data = $request->only($message->getFillable());
        // $message->fill($data)->save();
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $getUser = Auth::user();
        $users = User::all()->where("id", "!=", Auth::getUser()->id);
        $unreadMessageCount = Mailbox::with("user")->where("user_id", "!=", $getUser["id"])->where("to", $getUser["email"])->where("mail_types", "unread")->count();

        return view("admin-components.mailbox.new-mail", ["users" => $users, 'unreadMessageCount' => $unreadMessageCount]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
