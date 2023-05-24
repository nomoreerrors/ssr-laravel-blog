<?php

namespace App\Observers;

use Illuminate\Support\Carbon;
use App\Models\BlogPosts;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BlogPostsObserver
{
    /**
     * Handle the BlogPosts "created" event.
     */
    public function created(BlogPosts $blogPost): void
    {
        //
    }


    public function creating(BlogPosts $blogPost): void
    {
        $this->setSlug($blogPost);
        $this->setPublishedAt($blogPost);
        $this->setExcerpt($blogPost);
        $this->setHtml($blogPost);
        $this->setUser($blogPost);
        
    }



    //AFTER
    /**
     * Handle the BlogPosts "updated" event.
     */
    public function updated(BlogPosts $blogPost): void
    {
        //
    }



    /**
     * Before saving to DB
     */
    public function updating(BlogPosts $blogPost): void
    {
        $this->setExcerpt($blogPost);
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
    }


    public function deleting(BlogPosts $blogPost): void
    {
        // dd(__METHOD__, $blogPost);


        //return false;
        //здесь может быть возврат false и сопутствующая логика для запрета удаления записи.
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




    protected function setHtml(BlogPosts $blogPost): void
    {
        if($blogPost->isDirty('content_raw'))
        //здесь будет генерация html
              $blogPost->content_html = $blogPost->content_raw;

    }


    /**
     * Если пользователь не авторизован, устанавливается пользователь по умолчанию
     */
    protected function setUser(BlogPosts $blogPost): void
    {
        $blogPost->user_id = Auth::id() ?? BlogPosts::UNKNOWN_USER;
    }
   




}
