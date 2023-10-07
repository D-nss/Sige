<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Inscricao;

class InscricaoAnaliseRelatorioFinalNotificar extends Notification
{
    use Queueable;

    private $inscricao;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Inscricao $inscricao)
    {
        $this->inscricao = $inscricao;
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
        $link = url('inscricao/' . $this->inscricao->id);

        return (new MailMessage)
            ->subject('Resposta da análise do relatório final da inscrição - '. $this->inscricao->titulo .'.')
            ->greeting('Olá!, ' . $this->inscricao->user->name)
            ->line('Acesse o link abaixo para verificar a resposta da análise do relatório final da inscrição - '. $this->inscricao->titulo .'.')
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
