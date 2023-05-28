<?php

namespace App\Jobs\GenerateCatalog;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AbstractJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->onQueue('generate-catalog');
         //очередь по умолч. для всех связанных задач
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->debug('done!');
    }

    /**
     * Выводит название исполняемого класса в log
     * с переданным аргументом
     */
    protected function debug(string $msg): void
    {
        
        $class = static::class;
        $msg = $msg . "{$class}"; 
        Log::info($msg);
    }
}
