<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AcaoExtensaoNotificarComissaoUnidade extends Notification
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
            ->subject('Proposta ' . $this->data['titulo'] . ' está aguardando sua análise.')
            ->line('Olá , a Ação de Extensão intitulada '. $this->data['titulo'] . ' está aguardando sua análise.')
            ->line('Observação: Caso esta ação não apareça como pendente a mesma foi analisada pro outro membro da comissão')
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
