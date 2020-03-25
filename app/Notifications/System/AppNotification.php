<?php

namespace App\Notifications\System;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AppNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $props;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($props)
    {
        $this->props = $props;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [/*'mail',*/ 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject($this->props->subject)
                    ->greeting($this->props->greetings)
                    ->line($this->props->message)
                    ->salutation('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'subject' => $this->props->subject,
            'message' => $this->props->message,
        ];
    }
}
//      $new  = str_replace("%HOSTNAME%",$data['db_host'],$database_file);
// 		$new  = str_replace("%USERNAME%",$data['db_user'],$new);
// 		$new  = str_replace("%PASSWORD%",$data['db_password'],$new);
// 		$new  = str_replace("%DATABASE%",$data['db_name'],$new);