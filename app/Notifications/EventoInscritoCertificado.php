<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventoInscritoCertificado extends Notification
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
        $cryptSim = \Illuminate\Support\Facades\Crypt::encryptString('sim/' . $this->data['id']);
        $linkSim = url('inscritos/confirmacao') . '/' . str_replace('09', '90', $cryptSim) ;

        return (new MailMessage)
                    ->subject('Certificado de participação no evento ' . $this->data['titulo_evento']  . '.')
                    ->line( $this->data['nome'] . ' , para acessar e gerar o certificado de participação no evento ' . $this->data['titulo_evento'] . ', por favor, clique no botão "Área de Inscrição", e entre na guia "Certificados".')
                    ->action('Área de Inscrição', $linkSim)
                    ->line('Caso não consiga clicar no link "Area do Inscrito", copie e cole no seu navegador o link que está no rodapé: ');
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
