<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Evento;

class EventoCancelamentoNotificar extends Notification
{
    use Queueable;

    private $evento;
    private $motivo;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Evento $evento, $motivo)
    {
        $this->evento = $evento;
        $this->motivo = $motivo;
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
        return (new MailMessage)
                    ->subject('Cancelamento do evento ' . $this->evento->titulo)
                    ->line('O evento ' . $this->evento->titulo . ' foi cancelado devido ao motivo abaixo:')
                    ->line($this->motivo)
                    ->line('Obrigado por usar nosso sistema.');
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
