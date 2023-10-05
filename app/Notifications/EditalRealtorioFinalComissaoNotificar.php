<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Inscricao;

class EditalRealtorioFinalComissaoNotificar extends Notification
{
    use Queueable;

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
        $url = url('/inscricao/show-novo/'. $this->inscricao->id);
        return (new MailMessage)
                ->subject('Relatório Final Aguardando sua Aprovação. Inscrição de Título: ' . $this->inscricao->titulo .'.')
                ->greeting('Olá! ')
                ->line('A proposta ' . $this->inscricao->titulo .' do edital ' . $this->inscricao->edital->titulo . ' está aguardando uma aprovação do realtório final')
                // ->line('Por favor avalie entre os dias '. date('d/m/Y', strtotime($dataInicioRecurso)) . ' até ' . date('d/m/Y', strtotime($dataFinalRecurso)))
                ->action('Clique aqui para prosseguir com a avaliação', $url)
                ->line('Caso tenha problemas entre em contato conosco')
                ->line('pex@unicamp.br ou suporte@proec.unicamp.br')
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
