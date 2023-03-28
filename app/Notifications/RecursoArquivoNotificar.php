<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\EventoInscrito;

class RecursoArquivoNotificar extends Notification
{
    use Queueable;

    private $inscrito;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(EventoInscrito $inscrito)
    {
        $this->inscrito = $inscrito;
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
        $link = url('evento/inscrito/' . \Illuminate\Support\Facades\Crypt::encryptString($this->inscrito->id));
        return (new MailMessage)
                ->subject('Recurso aberto em analise feita por você.')
                ->greeting('Olá!, ' . $this->inscrito->analista['name'])
                ->line('Acesse o link abaixo para verificar o recurso que foi aberto.')
                ->action('Acessar Inscrição', $link)
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
