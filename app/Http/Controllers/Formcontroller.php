<?php

namespace App\Http\Controllers;

use AfricasTalking\SDK\AfricasTalking;
use App\Mail\Contactmail;
use App\Mail\Quotemail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class Formcontroller extends Controller
{
    public function quote(Request $request){

        $data = request();



        $contact = $request->phone;
        $user = $request->name;

        Alert::success('Thank  you', $user.'For requesting quotation,we get back to you');


        $message = 'Thank  you ' .$user.' For requesting quotation,we get back to you';
        $this->sendMessageProper("0734139465", "Hi ".$user." have requested for a quotation, view quotation here https://mailtrap.io/inboxes/1787214/messages");
        $this->sendMessageProper($contact, $message);

        Mail::to('yitzhaknjenga@gmail.com')->send(new Quotemail($data));
        return redirect()->back();
    }

    public function contact(Request $request){

        $data = request();

        $contact = $request->phone;
        $user = $request->name;


        Alert::success('Thank  you', $user.' For contacting us,we have received your message');

        $message = "Thank you ".$user." For Contacting Us, we have received your message";
        $this->sendMessageProper($contact, $message);
        $this->sendMessageProper("0734139465", "Hi ".$user." have contacted you, view message here https://mailtrap.io/inboxes/1787214/messages");
        Mail::to('yitzhaknjenga@gmail.com')->send(new Contactmail($data));
        return redirect()->back();

    }

    public function sendMessageProper($phone, $message)
    {
        if (Str::startsWith($phone, "07")) {
            $phone = '+254' . (substr(($phone), 1));
        } elseif (Str::startsWith($phone, "7")) {
            $phone = Str::start($phone, '+254');
        } elseif (Str::startsWith($phone, "254")) {
            $phone = Str::start($phone, '+');
        }
        $apiKey = env('AT_API_KEY', 'KEY');
        $username = env('AT_USERNAME');
        $AT = new AfricasTalking($username, $apiKey);
        $sms = $AT->sms();
        $result = $sms->send([
            'from' => 'mCarFix',
            'to' => $phone,
            'message' => $message
        ]);
    }
}
