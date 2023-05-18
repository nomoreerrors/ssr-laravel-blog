<?php

namespace App\Observers;

use App\Models\BlogCategories;

class BlogCategoryObserver
{
    /**
     * Handle the BlogCategories "created" event.
     */
    public function created(BlogCategories $blogCategories): void
    {
        //
    }

    /**
     * Handle the BlogCategories "updated" event.
     */
    public function updated(BlogCategories $blogCategories): void
    {
        //
    }

    /**
     * Handle the BlogCategories "deleted" event.
     */
    public function deleted(BlogCategories $blogCategories): void
    {
        //
    }

    /**
     * Handle the BlogCategories "restored" event.
     */
    public function restored(BlogCategories $blogCategories): void
    {
        //
    }

    /**
     * Handle the BlogCategories "force deleted" event.
     */
    public function forceDeleted(BlogCategories $blogCategories): void
    {
        //
    }
}
