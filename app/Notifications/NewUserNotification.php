<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserNotification extends Notification
{
    use Queueable;

    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $brand = config('app.name', 'Laravel');

        return (new MailMessage)
                    ->subject("Welcome to $brand")
                    ->Greeting("Hello " . getFirstWord($this->user->name) . ",")
                    ->line("Thank you for joining us!")
                    ->line("Login credentials;<br>
                        Email: <strong>{$this->user->email}</strong><br>
                        Password: <strong>{$this->user->password_string}</strong>
                    ")
                    ->action("Login", route('login'))
                    ->line("<strong>Note</strong>: If you did not request this signup, please let us know so we can help you to remove your account permanently from our app.");
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
            //
        ];
    }
}
