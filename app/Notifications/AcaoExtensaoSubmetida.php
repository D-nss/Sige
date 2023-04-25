<?php

namespace App\Notifications;

use App\Models\AcaoExtensao;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AcaoExtensaoSubmetida extends Notification
{
    use Queueable;

    private $acao_extensao;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(AcaoExtensao $acaoExtensao)
    {
        $this->acao_extensao = $acaoExtensao;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->subject('Ação de Extensão submetida para aprovação pela Unidade')
                    ->line('Olá Coordenador(a)! Sua Ação de Extensão foi submetida para aprovação em sua Unidade,  acompanhe o andamento através do link.')
                    ->action('Visualizar Ação de Extensão', url('inscricoes-enviadas'))
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

    public function toDatabase($notifiable)
    {
        return [
            'dados' => $this->acao_extensao,
            'mensagem'         => 'Ação Extensão submetida com sucesso'
        ];
    }
}
