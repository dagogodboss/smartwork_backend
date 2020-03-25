<?php

namespace App\Notifications\User\Transaction;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WithdrawalNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $transaction;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
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
                    ->subject(config('email.withdrawal.subject'))
                    ->greeting("Hello, {$notifiable->name}")
                    ->line(config('email.withdrawal.message'))
                    ->line('Thank you for using our Smart Motion!');
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
            'subject' => config('email.withdrawal.subject'),
            'message' => config('email.withdrawal.message'). 'Amount is: ' .$this->transaction->amount,
        ];
    }
}
