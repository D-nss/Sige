<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\AcaoExtensaoOcorrencia;

class NotificarAceiteCurricularizacao extends Notification
{
    use Queueable;

    private $acao_extensao_ocorrencia;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(AcaoExtensaoOcorrencia $acao_extensao_ocorrencia)
    {
       $this->acao_extensao_ocorrencia = $acao_extensao_ocorrencia;
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
                    ->subject('Resposta do coordenador sobre sua participação em ação de extensão')
                    ->line('Sua participação na ação de extensão "'. $this->acao_extensao_ocorrencia->acao_extensao->titulo .'" foi aceita.')
                    ->line('Data Inicio: '. date('d/m/Y', $this->acao_extensao_ocorrencia->data_hora_inicio))
                    ->line('Data Fim: '. date('d/m/Y', $this->acao_extensao_ocorrencia->data_hora_fim))
                    //->action('Notification Action', url('/'))
                    ->line('Obrigado por usar nosso sistema')
                    ->line('Equipe Extecult');
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
