<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AcaoExtensaoNotificaAtConextCiencia extends Notification
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
        return (new MailMessage)
            ->subject('Proposta ' . $this->data['titulo'] . ' foi analisada pelo comitê consultivo.')
            ->line('Olá , a Ação de Extensão intitulado '. $this->data['titulo'] . ' foi analisada pelo comissão de graduação e está disponível para ciência.')
            ->line('Para visualizar, entre na Extecult, clicando no botão abaixo.')
            ->action('Acessar área de ciência das Ações de Extensão', url('acoes-extensao-ciencia-conext'));
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
