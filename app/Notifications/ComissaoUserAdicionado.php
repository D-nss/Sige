<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\ComissaoUser;
use App\Models\Cronograma;

class ComissaoUserAdicionado extends Notification
{
    use Queueable;

    private $comissao_user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ComissaoUser $comissao_user)
    {
        $this->comissao_user = $comissao_user;
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
        $cronograma = new Cronograma();
        $dataInicioAnalise = $cronograma->getDate('dt_org_tematica', $this->comissao_user->comissao->edital->id);
        $dataFinalAnalise = $cronograma->getDate('dt_termino_org_tematica', $this->comissao_user->comissao->edital->id);
        
        return (new MailMessage)
                        ->subject('Participação em comissão do edital "'. $this->comissao_user->comissao->edital->titulo .'".')
                        ->greeting('Olá! ' . $this->comissao_user->user->name )
                        ->line('Você foi adicionado a comissão para análise prévia das proposta do edital ' . $this->comissao_user->comissao->edital->titulo . '.')
                        ->line('Por favor analíse entre os dias ' . date('d/m/Y', strtotime($dataInicioAnalise)) . ' e ' . date('d/m/Y', strtotime($dataFinalAnalise)))
                        ->action('Clique aqui para prosseguir com a análise', url('/inscricao'))
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
