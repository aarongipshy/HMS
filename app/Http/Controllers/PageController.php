<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Mailjet\Resources;
use Mailjet\Client;

class PageController extends Controller
{
    // About Us
    function about_us()
    {
        return view('about_us');
    }

    // Contact Us Form
    function contact_us()
    {
        return view('contact_us');
    }

    // Save Contact Us Form
    function save_contactus(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'msg' => 'required',
        ]);
    
        try {
            $data = [
                'name' => $request->full_name,  // Changed from 'full_name' to 'name'
                'email' => $request->email,
                'subject' => $request->subject,
                'msg' => $request->msg
            ];
    
            Mail::send('mail', $data, function($message) use ($request) {
                $message->to('layh282004@gmail.com')
                        ->subject('Contact Form: ' . $request->subject);
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });
    
            Log::info('Email sent successfully via Laravel Mail');
            return redirect('page/contact-us')->with('success', 'Your message has been sent successfully. We will contact you soon.');
        } catch (\Exception $e) {
            Log::error('Failed to send email: ' . $e->getMessage());
            return redirect('page/contact-us')->with('error', 'Sorry, there was an error sending your message: ' . $e->getMessage());
        }
    }
}
