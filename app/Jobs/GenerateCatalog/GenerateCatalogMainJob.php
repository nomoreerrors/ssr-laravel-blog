<?php

namespace App\Jobs\GenerateCatalog;

use Generator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Arr;

class GenerateCatalogMainJob extends AbstractJob
{

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->debug('start!');



        
        $pricesChain = $this->getChainPrices();
        
        Bus::chain(
            Arr::collapse([
                new GenerateCatalogCacheJob,
                $pricesChain,
                [
                    new GenerateCategoriesJob,  
                    new GenerateDeliveriesJob,  
                    new GeneratePointsJob, 
                    new ArchiveUploadsJob, 
                    new SendPriceRequestJob, 
                    new GenerateGoodsFileJob
                ]
           ])
        )->dispatch();
        
    }


    private function getChainPrices(): array
    {
        $products = collect([
                        'Phone',
                        'Paper' => '500$'
                        ,'chair' => '100$'
                        ,'sofa' => '200$'
                        ,'table' => '300$'
                        ,'TV' => '5440$'
                        ,'mouse' => '100$'
                        ,'Computer' => '200$'
                        ,'adapter' => '540$'
                        ,'pipe' => '566$'
                    ]);


     
       
        foreach ($products->chunk(3) as $product) {
            static $fileNum = 1;
            $result[] = new GeneratePricesFileChunkJob($product, $fileNum);
            $fileNum++;
        }
        return $result;
    }



}
