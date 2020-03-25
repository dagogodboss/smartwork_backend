<?php

namespace App\Jobs\User;

use App\Helper\Request\CurlRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class WithdrawHttpRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $user, $bank, $amount;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $bank, $amount )
    {
        $this->user = $user;
        $this->bank = $bank;
        $this->amount = $amount;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        CurlRequest::postJsonData(
            config('api.withdraw'),
            [$this->params]
        );
    }
}
