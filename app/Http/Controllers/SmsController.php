<?php

namespace App\Http\Controllers;

use Twilio\Rest\Client as Client;
use Exception;

class SmsController extends Controller
{
    public $account_sid;
    public $auth_token;
    public $twilio_number;
    // public $twilioClient;

    public function __construct()
    {
        $this->account_sid = getenv('TWILIO_SID');
        $this->auth_token = getenv('TWILIO_SID');
        $this->twilio_number = getenv("TWILIO_PHONE");
        // $this->twilioClient = new Client($this->account_sid, $this->auth_token);
    }


    public function twilioClient()
    {
        return new Client(getenv('TWILIO_SID'), getenv('TWILIO_AUTH_TOKEN'));
    }
    public function sendSms($phone_number, $message)
    {
        try {

            $this->twilioClient()->messages->create($phone_number, [
                'from' => $this->twilio_number,
                'body' => $message
            ]);
            return true;
        } catch (Exception $e) {
            dd("Error: " . $e->getMessage());
        }
    }
}
