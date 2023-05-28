<?php

namespace App\Jobs\GenerateCatalog;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GeneratePricesFileChunkJob extends AbstractJob
{

    
   public $fileNum;
   public $product;

   public function __construct(string $product, int $fileNum)
   {     
         parent::__construct();
         $this->fileNum = $fileNum;
         $this->product = $product;
   }

   public function handle(): void
   {
      Log::info('это файлнум:' . $this->fileNum . 'А это продуктнам:' . $this->product);
   }
   
        
   
 
}
