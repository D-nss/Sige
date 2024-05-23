<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AcaoExtensaoNotificacaoAceiteGraduacao extends Notification
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
            ->subject('Proposta ' . $this->data['titulo'] . ' aceita pela comissão de graduação.')
            ->line('Olá , a Ação de Extensão intitulada '. $this->data['titulo'] . ' foi aceita pela comissão de graduação, sendo liberada para curricularização.')
            ->line('Para visualizar, entre na Extecult, clicando no botão abaixo.')
            ->action('Visualizar Ação de Extensão', url('/acoes-extensao/' . $this->data['id'] ));
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
