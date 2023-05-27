<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BlogPostsDeletedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private int $blogPostId;


    /**
     * Create a new job instance.
     */
    public function __construct($blogPostId)
    {
        $this->blogPostId = $blogPostId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        logs()->warning("Создана новая запись в блоге {$this->blogPostId}");
    }
}
