<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventoInscritoLinkPainelNotificao extends Notification
{
    use Queueable;

    protected $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
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
        $link = url('evento/inscrito/' . \Illuminate\Support\Facades\Crypt::encryptString($this->data['id']));

        if($this->data['nome_social'] != NULL) {
            $nome = $this->data['nome_social'];
        } else {
            $nome = $this->data['nome'];
        }

        return (new MailMessage)
            ->subject('Acompanhamento de inscrição no evento ' . $this->data['titulo_evento']  . '.')
            ->line( 'Olá ' . $nome . ', caso você deseja acompanhar sua inscrição clique no botão abaixo.' )
            ->action('Acompanhar Inscrição', $link)
            ->line('Caso não consiga clicar no botão "Acompanhar Inscrição", copie e cole no seu navegador o link abaixo: ')
            ->line($link)
            ->line('Obrigado por usar nosso sistema!');
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
