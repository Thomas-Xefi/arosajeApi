<?php

namespace App\Notifications;

use App\Models\Plant;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PlantIsGuardedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Plant $plant
    )
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->from($this->plant->guardian->email, "{$this->plant->guardian->firstname} {$this->plant->guardian->lastname}")
            ->subject('Votre plante est guardée')
            ->greeting("Bonjour, $notifiable->firstname $notifiable->lastname")
            ->line("{$this->plant->guardian->firstname} {$this->plant->guardian->lastname} garde votre plante")
            ->line("Vous pouvez le contacter en répondant à ce mail ou par téléphone au {$this->plant->guardian->phone_number}");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'plant' => $this->plant->name,
            'guardian' => "{$this->plant->guardian->firstname} {$this->plant->guardian->lastname}"
        ];
    }
}
