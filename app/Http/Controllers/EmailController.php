<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function contact(Request $request) {
        $input = $request->all();
        $email = $input['email'];
        $name = $input['name'];
        $body = $input['body'];

        Mail::send('emails.contact',[
            'email'=> $email,
            'name'=> $name,
            'body'=> $body
        ],function($message) use($email) {
            $message->from($email,'contact page');
            $message->to('bba8ee446d-bfa052@inbox.mailtrap.io');
        });

        return response()->json(['message'=>'request completed']);
    }
}
