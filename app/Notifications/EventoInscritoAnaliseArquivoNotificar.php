<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\EventoInscrito;

class EventoInscritoAnaliseArquivoNotificar extends Notification
{
    use Queueable;

    protected $inscrito;

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
        $mensagem = '';

        if($this->inscrito->nome_social != NULL) {
            $nome = $this->inscrito->nome_social;
        } else {
            $nome = $this->inscrito->nome;
        }

        if($this->inscrito->status_arquivo == 'Pendente') {
            $mensagem .= 'Seu projeto foi aceito pela equipe do evento, mas possui ressalvas, acesse o seu painel de inscrição para verificar as observações. Para acessar seu painel clique no link abaixo.';
        }
        elseif($this->inscrito->status_arquivo == 'Aceito') {
            $mensagem = 'Seu projeto foi aceito pela equipe do evento. Para acessar seu painel clique no link abaixo.';
        }
        else {
            $mensagem = 'Seu projeto não foi aceito pela equipe do evento, você pode abrir um recurso e solicitar uma reavaliação, acesse o seu painel clicando no link abaixo.';
        }
        return (new MailMessage)
                    ->subject('Resposta da análise de envio de arquivo na inscrição no evento ' . $this->inscrito->evento->titulo  . '.')
                    ->line( 'Olá, '. $nome )
                    ->line( $mensagem )
                    ->action('Painel Inscrição', $link)
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
