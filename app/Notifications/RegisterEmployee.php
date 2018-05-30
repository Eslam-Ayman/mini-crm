<?php
// this directory and this file has been created automatically with its content code 
// by runing this comand >>> php artisan  make:notification RegisterEmployee

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RegisterEmployee extends Notification
{
    use Queueable;

    protected $employee;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($employee)
    {
        $this->employee = $employee;
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
        return (new MailMessage)/*->view('notifications.mail', ['employee'=> $this->employee]);*/
                    ->line('Hello, ' . $this->employee->f_name)
                    ->line('you have invited to CRM website and you can sign in with this cardintials')
                    ->line('Email : ' . $this->employee->email)
                    ->line('Password : ' . $this->employee->password)
                    ->action('Go to Sign In', url('/login'))
                    ->line('Thank you for using our application!');
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
