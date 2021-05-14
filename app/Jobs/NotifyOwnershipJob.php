<?php

namespace App\Jobs;

use App\Models\Ownership;
use App\Services\NotifyOwnership as ServicesNotifyOwnership;
use App\Services\NotifyOwnershipService;
use Carbon\CarbonInterval;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NotifyOwnershipJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The ownership instance.
     *
     * @var \App\Models\Ownership
     */
    protected $ownership;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Ownership $ownership)
    {
        $this->ownership = $ownership;
    }

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    // public $timeout = 120;

    /**
     * Determine the time at which the listener should timeout.
     *
     * @return \DateTime
     */
    // public function retryUntil()
    // {
    //     return now()->addSeconds(10);
    // }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $release_time = CarbonInterval::seconds(5);

        Log::debug("💬 attempt: {$this->attempts()} | Enviando notificação para {$this->ownership->firstname} {$this->ownership->lastname}");

        $status = (new NotifyOwnershipService($this->ownership))->exec();

        if ($status) {

            Log::debug("✔️ attempt: {$this->attempts()} | Notificação enviada com sucesso para {$this->ownership->firstname} {$this->ownership->lastname}");

            // job success
            return;
        }

        Log::debug("❌ attempt: {$this->attempts()} | Erro ao enviar notificação para {$this->ownership->firstname} {$this->ownership->lastname} | Tentando novamente em {$release_time}");

        if ($this->attempts() < $this->tries) {
            $this->release($release_time);
        } else {
            $this->fail(new Exception("Alguma treta aconteceu para o cliente {$this->ownership->firstname} {$this->ownership->lastname}"));
        }
    }

    /**
     * Handle a job failure.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(\Throwable $exception)
    {
        // Send user notification of failure, etc...

        Log::debug($exception->getMessage());
    }
}
