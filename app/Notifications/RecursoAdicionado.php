<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Inscricao;
use App\Models\Cronograma;

class RecursoAdicionado extends Notification
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
        $dataInicioRecurso = $cronograma->getDate('dt_recurso', $this->inscricao->edital_id);
        $dataFinalRecurso= $cronograma->getDate('dt_termino_recurso', $this->inscricao->edital_id);
        $url = url('/inscricao/'. $this->inscricao->id . '/recurso');
        return (new MailMessage)
                ->subject('Recurso aberto para proposta "'. $this->inscricao->titulo .'".')
                ->greeting('Olá! ')
                ->line('A proposta ' . $this->inscricao->titulo .' do edital ' . $this->inscricao->edital->titulo . ' está aguardando uma avaliação de recurso aberto')
                ->line('Por favor avalie entre os dias '. date('d/m/Y', strtotime($dataInicioRecurso)) . ' até ' . date('d/m/Y', strtotime($dataFinalRecurso)))
                ->action('Clique aqui para prosseguir com a avaliação', $url)
                ->line('Caso tenha problemas entre em contato conosco')
                ->line('pex@unicamp.br ou suporte@proec.unicamp.br</br>')
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
