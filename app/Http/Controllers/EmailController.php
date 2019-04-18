<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function contact(Request $request) {
        $input = $request->all();
        $email = $input['email'];
        $email = $input['name'];
        $email = $input['body'];

        Mail::send('emails.contact',[
            'email'=> $email,
            'name'=> $name,
            'body'=> $body
        ],function($message){
            $message->from('user@gmail.com','contact page');
            $message->to('bba8ee446d-bfa052@inbox.mailtrap.io');
        });

        return responce()->json(['message'=>'request completed']);
    }
}
