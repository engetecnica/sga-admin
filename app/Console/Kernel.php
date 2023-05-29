<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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

        //Backup agendado para ser executado as 2:00 de cada semana no Domingo.
        $schedule->command('backup:run')
            ->weekly()
            ->sundays()
            ->timezone('America/Sao_Paulo')
            ->at('02:00');

        // TUTORIAL
        // Para rodar o comando corretamente, acesse o servidor de hospedagem, geralmente em SSH.
        // 1) Acesse até a pasta do projeto e digite o comando "pwd" para pegar o path do projeto. ANOTE: /caminho/do/projeto
        // 2) Digite o comando "crontab -e" e escolha o NANO para editar o arquivo. [-e de edit]
        // 3) É só digitar: "* * * * * cd /caminho/para/o/projeto && php artisan schedule:run >> /dev/null 2>&1" [sem aspas]. CTRL + 0 para salvar e CTRL + X para sair e Y para confirmar.
        // 4) Para ver o cron job (lista de tarefas agendadas), digite o comando "crontab -l" e será exibida a lista de tarefas. [-l de list]

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
