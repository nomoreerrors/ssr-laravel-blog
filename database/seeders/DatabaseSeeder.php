<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BlogCategories;
use App\Models\BlogPosts;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
       User::factory(30)->create();
       BlogCategories::factory(11)->create();
       BlogPosts::factory(50)->create();

       
    // dd(BlogCategories::factory(11)->make());


    }

    //Как вывести factory в консоль:
    // public function run(): void
    // {
    //  $result =  BlogCategories::factory(11)->make();
    //     dd($result);
 
    // }
}
