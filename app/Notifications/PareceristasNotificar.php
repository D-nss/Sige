<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Inscricao;
use App\Models\Cronograma;

class PareceristasNotificar extends Notification
{
    use Queueable;

    protected $inscricao;

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
        $dataInicioAnalise = $cronograma->getDate('dt_recurso', $this->inscricao->edital->id);
        $dataFinalAnalise = $cronograma->getDate('dt_termino_recurso', $this->inscricao->edital->id);

        $url = url("/edital/". $this->inscricao->edital->id . "/inscricoes");

        return (new MailMessage)
                    ->subject('Reanálise de avaliação de inscrição do Edital ' . $this->inscricao->edital->titulo)
                    ->greeting('Olá! ')
                    ->line('A inscrição ' . $this->inscricao->titulo . ' necessita de sua atenção. Verifique se o recurso em aberto se refere a sua avaliação.')
                    ->line('Por favor reanalise entre os dias ' . date('d/m/Y', strtotime($dataInicioAnalise)) . ' e ' . date('d/m/Y', strtotime($dataFinalAnalise)))
                    ->action('Clique aqui para prosseguir com a análise', $url)
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
