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

class GenerateCatalogMainJob extends AbstractJob
{

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->debug('start!');


        //Выполняем все основные запросы в этой задаче
        //и кэшируем, чтобы повторно не обращаться
        //(пока только в фантазиях)
        GenerateCatalogCacheJob::dispatchSync();
        //отправить задачу сихронно(немедленно, без ожидания)


        // Идем от сложного к простому (от более вероятного получения неудачи)
        //Получаем массив экземпляров класса GeneratePricesFileChunkJob
        //(разделяем большой объем данных на несколько кусков)
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

        //отправляем все задачи в очередь

        GenerateGoodsFileJob::dispatch()->chain($chain);
        
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

        $fileNum = 1;
     
        foreach ($products->chunk(3) as $product) {
            $result[] = new GeneratePricesFileChunkJob($product, $fileNum);
            $fileNum++;
            //Разбиваем большой файл с ценами товаров на несколько
            //Получаем массив экземпляров класса в $result
        }
        return $result;
    }



}
