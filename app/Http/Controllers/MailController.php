<?php

namespace App\Http\Controllers;

use App\Mail\MailNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        $data = [
            'subject' => 'Agroinvity',
            'body' => 'Ini link reset anda',
        ];

        Mail::to('lupicalnocturn@gmail.com')
            ->send(new MailNotify($data));
        return view('forms.sent', ['requested' => true]);
    }
}
