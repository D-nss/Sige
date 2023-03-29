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
        $cryptSim = \Illuminate\Support\Facades\Crypt::encryptString('sim/' . $this->data['id']);
        $linkSim = url('inscritos/confirmacao') . '/' . str_replace('09', '90', $cryptSim) ;

        $cryptNao = \Illuminate\Support\Facades\Crypt::encryptString('nao/' . $this->data['id']);
        $linkNao = url('inscritos/confirmacao') . '/' . str_replace('09', '90', $cryptNao) ;

        if($this->data['nome_social'] != NULL) {
            $nome = $this->data['nome_social'];
        } else {
            $nome = $this->data['nome'];
        }

        return (new MailMessage)
                    ->subject('Confirmação de inscrição no evento ' . $this->data['titulo_evento']  . '.')
                    ->line( $nome . ' por favor confirme sua inscrição no evento ' . $this->data['titulo_evento']  . '.' )
                    ->action('Confirmar Inscrição', $linkSim)
                    ->line('Caso não consiga clicar no link "Confirmar Inscrição", copie e cole no seu navegador o link que está no rodapé: ')
                    ->line('Caso queira cancelar a sua inscrição clique neste link:')
                    ->line($linkNao)
                    ->line('Caso não consiga clicar no link de cancelamento, copie e cole o link no seu navegador.');
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
