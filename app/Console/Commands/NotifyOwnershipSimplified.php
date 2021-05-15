<?php

namespace App\Console\Commands;

use App\Jobs\NotifyOwnership as JobsNotifyOwnership;
use App\Models\Ownership;
use App\Services\NotifyOwnershipService;
use App\Support\DripEmailer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class NotifyOwnershipSimplified extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'notifications:ownership {ownership=gustavo}';
    // protected $signature = 'notifications:ownership {ownership=gustavo} {--all}';
    protected $signature = 'notifications:ownership-simplified {ownerships?* : Ownership id} {--all : Notify all ownerships} {--with-ticket : Notify all ownerships with ticket}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a notification to a ownership about traffic ticket [simplified]';

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
        if ($this->option('all')) {
            $ownerships = Ownership::all();
        } else if ($this->option('with-ticket')) {
            $ownerships = Ownership::where('traffic_ticket', '1')->get();
        } else {
            if (empty($this->argument('ownerships'))) {
                return;
            }

            $ownerships = Ownership::find([
                $this->argument('ownerships')
            ]);
        }

        // dd($ownerships->toArray());

        if ($ownerships->isEmpty()) {
            Log::error('Nenhum proprietário encontrado para o CPF informado.');
            return;
        }

        foreach ($ownerships as $ownership) {

            Log::debug("💬 Enviando notificação via artisan para {$ownership->firstname} {$ownership->lastname}");

            $status = (new NotifyOwnershipService($ownership))->exec();

            if ($status) {
                Log::debug("✔️ Notificação enviada com sucesso para {$ownership->firstname} {$ownership->lastname}");
            } else {
                Log::debug("❌ Erro ao enviar notificação para {$ownership->firstname} {$ownership->lastname}");
            }

            // sleep(1);
        }

        // ##########################################

        // foreach ($ownerships as $ownership) {
        //     JobsNotifyOwnership::dispatch($ownership);
        //     // sleep(1);
        //     $bar->advance();
        // }

        // $bar->finish();

        // $this->newLine(2);
        // $this->info('As notificações foram despachadas para fila. Em alguns minutos todos serão notificados');
        // $this->newLine();
    }
}
