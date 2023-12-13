<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Inscricao;

class InscricaoSubmetida extends Notification
{
    use Queueable;

    private $inscricao;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Inscricao $inscricao)
    {
        $this->inscricao = $inscricao;
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
        $url = url('edital/'.$this->inscricao->edital->id.'/suas-inscricoes');
        return (new MailMessage)
                    ->subject('Confirmação de inscrição')
                    ->line('Sua inscrição foi enviada com sucesso em nosso sistema, acompanhe o andamento através do link.')
                    ->action('Acompanhar', $url)
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
            'dados' => $this->inscricao,
            'mensagem'         => 'Inscrição submetida com sucesso'
        ];
    }
}
