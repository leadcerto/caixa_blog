<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    public function saved(Post $post): void
    {
        $this->clearSitemapCache();
    }

    public function deleted(Post $post): void
    {
        $this->clearSitemapCache();
    }

    public function restored(Post $post): void
    {
        $this->clearSitemapCache();
    }

    public function forceDeleted(Post $post): void
    {
        $this->clearSitemapCache();
    }

    private function clearSitemapCache(): void
    {
        Cache::forget('sitemap.xml');
    }
}
