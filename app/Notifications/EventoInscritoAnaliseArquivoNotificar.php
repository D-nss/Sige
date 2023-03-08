<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventoInscritoNotificar extends Notification
{
    use Queueable;

    protected $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
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
        $link = url('evento/inscrito/' . $data['id']);
        $mensagem = '';

        if($data['status_arquivo'] == 'Aceito') {
            $mensagem = 'Seu projeto foi aceito pela equipe do evento. Para acessar seu painel clique no link abaixo.';
        }
        else {
            $mensagem = 'Seu projeto não foi aceito pela equipe do evento, você pode abrir um recurso e solicitar uma reavaliação, acesse o seu painel clicando no link abaixo.';
        }
        return (new MailMessage)
                    ->subject('Resposta da análise de envio de arquivo na inscrição no evento ' . $this->data['titulo_evento']  . '.')
                    ->line( 'Olá, '. $this->data['nome'] )
                    ->line( $mensagem )
                    ->action('Painel Inscrição', $link)
                    ->line('Caso não consiga clicar no link, copie e cole no seu navegador.')
                    ->line($link);
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
