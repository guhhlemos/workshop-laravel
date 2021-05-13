<?php

namespace App\Console\Commands;

use App\Jobs\NotifyOwnershipByEmail as JobsNotifyOwnershipByEmail;
use App\Models\Ownership;
use App\Support\DripEmailer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class NotifyOwnershipByEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'notify:send-email {ownership=gustavo}';
    // protected $signature = 'notify:send-email {ownership=gustavo} {--all}';
    protected $signature = 'notify:send-email {ownerships?* : Ownership cpf} {--all : Notify all ownerships}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a email to a ownership about traffic ticket';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param  \App\Support\DripEmailer  $drip
     * @return mixed
     */
    public function handle()
    {
        // dd($this->option('all'));
        // dd($this->argument('ownership'));
        // dd($this->argument('ownerships'));

        if ($this->option('all')) {
            $ownerships = Ownership::all();
        } else {

            if (empty($this->argument('ownerships'))) {

                $ownerships = Ownership::where(
                    'cpf',
                    // $this->anticipate('Para qual proprietário você deseja enviar a notificação?', ['gustavo', 'douglas'])
                    $this->ask('Para qual proprietário você deseja enviar a notificação?')
                )->get();
            } else {
                $ownerships = Ownership::whereIn(
                    'cpf',
                    $this->argument('ownerships')
                )->get();
            }
        }

        // dd($ownerships->toArray());

        if ($ownerships->isEmpty()) {
            $this->error('Nenhum proprietário encontrado para o CPF informado.');
            $this->newLine();
            return;
        }

        $this->table(
            ['firstname', 'lastname', 'cpf'],
            $ownerships->map->only(['firstname', 'lastname', 'cpf'])
        );

        if ($this->confirm('Deseja confirmar o envio da notificação para os proprietários?') === false) {
            $this->info('envio não confirmado');
            return;
        }

        $bar = $this->output->createProgressBar(count($ownerships));

        $bar->start();

        // foreach ($ownerships as $ownership) {

        //     Log::info("enviando notificação via artisan para [{$ownership->cpf}] {$ownership->firstname} {$ownership->lastname}");

        //     // sleep(1);
        //     $bar->advance();
        // }

        // $bar->finish();

        // $this->newLine(2);
        // $this->info('Notificações enviadas!');
        // $this->newLine();

        foreach ($ownerships as $ownership) {

            JobsNotifyOwnershipByEmail::dispatch($ownership);

            // sleep(1);
            $bar->advance();
        }

        $bar->finish();

        $this->newLine(2);
        $this->info('As notificações foram despachadas para fila. Em alguns minutos todos serão notificados');
        $this->newLine();
    }
}
