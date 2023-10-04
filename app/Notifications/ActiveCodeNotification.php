<?php

namespace App\Notifications;

use App\Notifications\Channels\GhasedakChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActiveCodeNotification extends Notification
{
    use Queueable;


    public $code ;
    public $phoneNumber ; 
    /**
     * Create a new notification instance.
     */
    public function __construct($code , $phoneNumber)
    {
        $this->code = $code ;
        $this->phoneNumber = $phoneNumber ;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [GhasedakChannel::class];
    }

    
    public function toGhasedakSms($notifiable)
    {
        return [
            'text' => "کد احراز هویت شما {$this->code} است \n وب سایت proshop . لغو 11",
            'number' => $this->phoneNumber ,
        ];
    }

}
