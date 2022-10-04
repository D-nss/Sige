<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Inscricao;
use App\Models\AvaliadorPorInscricao;
use App\Models\Cronograma;

class AdicionarAvaliador extends Notification
{
    use Queueable;

    private $inscricao;
    private $avaliador;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(AvaliadorPorInscricao $avaliador)
    {
        $this->inscricao = Inscricao::find($avaliador->inscricao_id);
        $this->avaliador = $avaliador;
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
        $dataInicioPareceristas = $cronograma->getDate('dt_pareceristas', $this->inscricao->edital_id);
        $dataFinalPareceristas = $cronograma->getDate('dt_termino_pareceristas', $this->inscricao->edital_id);
        $url = url('/inscricao/'. $this->inscricao->id . '?tipo_avaliacao=parecerista');
        return (new MailMessage)
                    ->subject('Proposta "'. $this->inscricao->titulo .'" está aguardando sua avaliação.')
                    ->greeting('Olá! ' . $this->avaliador->user->name )
                    ->line('A proposta ' . $this->inscricao->titulo .' do edital ' . $this->inscricao->edital->titulo . ' está aguardando sua avaliação')
                    ->line('Por favor avalie entre os dias'. date('d/m/Y', strtotime($dataInicioPareceristas)) . ' até ' . date('d/m/Y', strtotime($dataFinalPareceristas)))
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
