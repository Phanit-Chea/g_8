<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class SendMailController extends Controller
{
    public function loadForm()
    {
        return view('form');
    }

    public function send(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'email' => 'required|email',
            'body' => 'required',
            'footer' => 'required',
        ]);

        $details = [
            'title' => $request->title,
            'body' => $request->body,
            'footer' => $request->footer,
        ];

        try {
            Mail::send('emails.sendEmail', $details, function($message) use ($request) {
                $message->to($request->email)
                        ->subject($request->title)
                        ->from('ratanakkhoeurn7@gmail.com', config('app.name'));
            });

            Session::flash('success', 'Email sent successfully.');
        } catch (\Exception $e) {
            Session::flash('error', 'Failed to send email. Error: ' . $e->getMessage());
        }

        return back();
    }
}
