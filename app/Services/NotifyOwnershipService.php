<?php

namespace App\Services;

use App\Models\Ownership;
use Illuminate\Support\Facades\Log;

class NotifyOwnershipService
{
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
     * Execute the notification.
     *
     * @return void
     */
    public function exec()
    {
        // Log::debug('executando o envio');

        // sleep(1);

        return (bool) random_int(0, 1);
    }
}
