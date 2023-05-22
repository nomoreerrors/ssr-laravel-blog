<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\BlogCategories;
use Illuminate\Support\Carbon;

class BlogCategoryObserver
{
    /**
     * Handle the BlogCategories "created" event.
     */
    public function created(BlogCategories $blogCategory): void
    {
        
    }

    /**
     * Before saving to database
     */
    public function creating(BlogCategories $blogCategory): void
    {
        $this->setSlug($blogCategory);

    }

    /**
     * Handle the BlogCategories "updated" event.
     */
    public function updated(BlogCategories $blogCategory): void
    {
        //
    }

    /**
     * Before saving to DB
     */
    public function updating(BlogCategories $blogCategory): void
    {
        // dd(__METHOD__, $blogCategory->isDirty());
        $this->setSlug($blogCategory);
    }

    /**
     * Handle the BlogCategories "deleted" event.
     */
    public function deleted(BlogCategories $blogCategory): void
    {
        //
    }

    /**
     * Handle the BlogCategories "restored" event.
     */
    public function restored(BlogCategories $blogCategory): void
    {
        //
    }

    /**
     * Handle the BlogCategories "force deleted" event.
     */
    public function forceDeleted(BlogCategories $blogCategory): void
    {
        //
    }




    protected function setSlug(BlogCategories $blogCategory): void
    {
        if(empty($blogCategory->slug)) {
            $blogCategory->slug= Str::slug($blogCategory->title);
        }
    }



   

}

