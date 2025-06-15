<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmail extends Command
{
    protected $signature = 'email:test';
    protected $description = 'Send a test email to verify mail configuration';

    public function handle()
    {
        $this->info('Sending test email...');
        
        try {
            Mail::raw('This is a test email from your Hotel Management System', function ($message) {
                $message->to('layh282004@gmail.com')
                        ->subject('Test Email');
            });
            
            $this->info('Test email sent successfully!');
        } catch (\Exception $e) {
            $this->error('Failed to send test email: ' . $e->getMessage());
        }
        
        return 0;
    }
}