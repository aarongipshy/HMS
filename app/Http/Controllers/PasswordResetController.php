<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Http;

class PasswordResetController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendOTP(Request $request)
    {
        $request->validate([
            'username' => 'required'
        ]);

        $admin = Admin::where('username', $request->username)->first();
        if (!$admin) {
            return back()->with('error', 'គណនីមិនត្រឹមត្រូវ!');
        }

        // Generate OTP
        $otp = rand(100000, 999999);
        
        // Store OTP in session
        session(['reset_otp' => $otp]);
        session(['reset_username' => $request->username]);

        // Send OTP via Telegram
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = $request->telegram_id; // '085548101'
        $message = "Your HMS Password Reset OTP: $otp";

        $response = Http::post("https://api.telegram.org/bot$botToken/sendMessage", [
            'chat_id' => $chatId,
            'text' => $message
        ]);

        if ($response->successful()) {
            return redirect()->route('password.otp')->with('success', 'OTP បានផ្ញើទៅ Telegram របស់អ្នក!');
        }

        return back()->with('error', 'មានបញ្ហាក្នុងការផ្ញើ OTP!');
    }

    public function showOTPForm()
    {
        return view('auth.verify-otp');
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric'
        ]);

        if ($request->otp != session('reset_otp')) {
            return back()->with('error', 'OTP មិនត្រឹមត្រូវ!');
        }

        return redirect()->route('password.reset')->with('success', 'សូមបញ្ចូលពាក្យសម្ងាត់ថ្មី');
    }

    public function showResetForm()
    {
        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        $admin = Admin::where('username', session('reset_username'))->first();
        $admin->password = sha1($request->password);
        $admin->save();

        session()->forget(['reset_otp', 'reset_username']);

        return redirect('admin/login')->with('success', 'ពាក្យសម្ងាត់ត្រូវបានផ្លាស់ប្តូរ!');
    }
}