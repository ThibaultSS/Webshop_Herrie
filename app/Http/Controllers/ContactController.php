<?php

namespace App\Http\Controllers;

use App\Mail\QuestionMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $name = $request->query('name');
        $email = $request->query('email');
        $messageText = $request->query('message');

        Mail::to('dedraakman@gmail.com')->send(new QuestionMessage($name, $email, $messageText));

        return redirect(env('ASTRO_URL') . "?status=ok");
    }
}
