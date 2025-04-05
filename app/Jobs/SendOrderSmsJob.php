<?php

namespace App\Jobs;

use Twilio\Rest\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendOrderSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $phone;
    protected $message;

    public function __construct($phone, $message)
    {
        $this->phone = "+91".$phone;
        $this->message = $message;
    }

    public function handle()
    {
        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $from = config('services.twilio.from');

        $twilio = new Client($sid, $token);

        $twilio->messages->create($this->phone, [
            'from' => $from,
            'body' => $this->message
        ]);
    }
}
