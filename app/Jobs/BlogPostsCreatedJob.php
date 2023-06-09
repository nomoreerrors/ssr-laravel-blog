<?php

namespace App\Jobs;

use App\Models\BlogPosts;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BlogPostsCreatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private object $blogPost;
    /**
     * Create a new job instance.
     */
    public function __construct(BlogPosts $blogPost)
    {
        $this->blogPost = $blogPost;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        logs()->info("Создана новая запись в блоге {$this->blogPost->id}");
    }
}
