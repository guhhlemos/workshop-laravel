<?php

namespace App\Jobs;

use App\Models\Ownership;
use App\Services\NotifyOwnershipByEmail as ServicesNotifyOwnershipByEmail;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NotifyOwnershipByEmail implements ShouldQueue
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

    // /**
    //  * The number of times the job may be attempted.
    //  *
    //  * @var int
    //  */
    // public $tries = 2;

    // /**
    //  * Determine the time at which the listener should timeout.
    //  *
    //  * @return \DateTime
    //  */
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
        $are_you_lucky = (bool) random_int(0, 1);

        sleep(1);

        if ($are_you_lucky === false) {

            $this->fail(new Exception('alguma treta aconteceu'));

            Log::error("attempt: {$this->attempts()} | Problema ao enviar notificação para [{$this->ownership->cpf}] {$this->ownership->firstname} {$this->ownership->lastname}");

            return;
        }

        Log::info("attempt: {$this->attempts()} | Enviando notificação através da fila para [{$this->ownership->cpf}] {$this->ownership->firstname} {$this->ownership->lastname}");
    }
}
