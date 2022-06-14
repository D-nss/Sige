<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Models\Cronograma;
use App\Models\Edital;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function(){
            $editais = Edital::select('titulo', 'id', 'status')->get();
            $data = new Cronograma();

            foreach($editais as $edital) {
                $data = $data->getDate('dt_termino_inscricao', $edital->id);
                 if(strtotime(date('Y-m-d')) > strtotime($data) && $edital->status == 'Divulgação' ) {
                     $edital = Edital::find($edital->id);
                     $edital->status = 'Em Andamento';
                     echo $edital->save() ? "Edital $edital->titulo alterado status para em andamento" : "Erro ao alterar o estatus do Edital $edital->titulo";
                }
            }

        })->dailyAt('00:01')->timezone('America/Fortaleza');

        $schedule->call(function(){
            $user = \App\Models\User::where('email', 'aadilson@unicamp.br')->first();//simulando usuário logado

            foreach($user->inscricoes as $inscricao) {
                $checaNotificacaoNaoLida = $inscricao->user->unreadNotifications->filter(function($value, $key) {
                    return data_get($value, 'type') == 'App\Notifications\OrcamentoFaltante';
                });

                if( empty($inscricao->orcamento->toArray()) && empty($checaNotificacaoNaoLida->toArray()) ) {
                    $inscricao->user->notify(new \App\Notifications\OrcamentoFaltante($inscricao));
                }
            }
        })->dailyAt('00:01')->timezone('America/Fortaleza');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
