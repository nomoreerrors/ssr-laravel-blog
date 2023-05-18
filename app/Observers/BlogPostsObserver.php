<?php

namespace App\Observers;

use Illuminate\Support\Carbon;
use App\Models\BlogPosts;
use Illuminate\Support\Str;

class BlogPostsObserver
{
    /**
     * Handle the BlogPosts "created" event.
     */
    public function created(BlogPosts $blogPost): void
    {
        //
    }


    //BEFORE
    // public function updating(BlogPosts $blogPost): void
    // {
        // $test[] = $blogPost->isDirty();
        // $test[] = $blogPost->isDirty('is_published');
        // $test[] = $blogPost->isDirty('user_id');
        // $test[] = $blogPost->getAttribute('is_published');
        // $test[] = $blogPost->is_published;
        // $test[] = $blogPost->getOriginal('is_published');
        // dd($test);
        // $this->setExcerpt($blogPost);
        // $this->setPublishedAt($blogPost);
        // $this->setSlug($blogPost);
        // dd('lolwuuuuut1');
    // }


    //AFTER
    /**
     * Handle the BlogPosts "updated" event.
     */
    public function updated(BlogPosts $blogPost): void
    {
        dd($blogPost->isDirty('content_raw'));
        
        $this->setExcerpt($blogPost);
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);

    }

    /**
     * Handle the BlogPosts "deleted" event.
     */
    public function deleted(BlogPosts $blogPost): void
    {
        //
    }

    /**
     * Handle the BlogPosts "restored" event.
     */
    public function restored(BlogPosts $blogPost): void
    {
        //
    }

    /**
     * Handle the BlogPosts "force deleted" event.
     */
    public function forceDeleted(BlogPosts $blogPost): void
    {
        //
    }

    /**
     * Если поле published_at в базе пустое и пришла единица из checkbox,
     * устанавливаем дату публикации
     */
    protected function setPublishedAt(BlogPosts $blogPost): void
    {
         if(empty($blogPost->published_at) && $blogPost->is_published) {
            $blogPost->published_at = Carbon::now()->add(3, 'hours');
         }
    }




    public function setSlug(BlogPosts $blogPost): void
    {
        if(empty($blogPost->slug))
            $blogPost->slug = Str::slug($blogPost->title);

    }




    public function setExcerpt(BlogPosts $blogPost): void
    {
        if(empty($blogPost->excerpt))
                $blogPost->excerpt = Str::words($blogPost->content_raw, 50);

    }
   




}
