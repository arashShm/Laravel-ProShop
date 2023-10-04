<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;
use Ghasedak\Exceptions\ApiException ;
use Ghasedak\Exceptions\HttpException;
use Ghasedak\GhasedakApi ;

class GhasedakChannel
{


    public function send($notifiable, Notification $notification)
    {
        if(! method_exists($notification , 'toGhasedakSms')){
            throw new \Exception('toGhasedakSms method not found');
        }
        $data = $notification->toGhasedakSms($notifiable);

        $message = $data['text'];
        $receptor = $data['number'] ;
        $apiKey = config('services.ghasedak.key') ;

        try {
            $lineNumber = "10008642";
            $api = new GhasedakApi($apiKey);
            $api->SendSimple($receptor, $message, $lineNumber);

        } catch (ApiException $e) {

            throw $e;

        } catch (HttpException $e) {

            throw $e;
        }
    }
}
