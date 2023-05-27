<?php

namespace App\Jobs\GenerateCatalog;

use Generator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateCatalogMainJob extends AbstractJob
{

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->debug('start');

        //Кэширование продуктов
        GenerateCatalogCacheJob::dispatchSync();

        //цепь заданий формирования файлов с ценами
        $pricesChain = $this->getChainPrices();


        $mainChain = [
            new GenerateCategoriesJob, //Генерация категорий
            new GenerateDeliveriesJob, //Способы доставки
            new GeneratePointsJob, //Пункты выдачи
        ];

        $lastChain = [
            new ArchiveUploadsJob, //архивирование и перенос в пуб. папку
            //к которой имеет доступ сторонний сервис
            new SendPriceRequestJob, //отправка уведомления стороннему сервису 
            //о возм. скачать обновления (файл товаров)
        ];

        $chain = array_merge($pricesChain, $mainChain, $lastChain);


        GenerateGoodsFileJob::dispatch()->chain($chain);
        
    }


    private function getChainPrices()
    {
        $products = collect([1,2,3,4,5]);
        $fileNum = 1;

        foreach ($products->chunk(1) as $chunk) {
            $result[] = new GeneratePricesFileChunkJob($chunk, $fileNum);
            $fileNum++;
        }
        return $result;
    }



}
