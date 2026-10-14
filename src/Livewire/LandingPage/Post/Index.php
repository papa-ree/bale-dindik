<?php

namespace Bale\BaleDindik\Livewire\LandingPage\Post;

use Bale\Umpak\Livewire\UmpakComponent;
use Livewire\Attributes\{Computed, Layout};

#[Layout('bale-dindik::layouts.app')]
class Index extends UmpakComponent
{
    public string $slug = 'post-section';

    public function mount(?string $slug = null): void
    {
        if ($slug) {
            $this->slug = $slug;
        }
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.post.index', [
            'section' => $this->section($this->slug),
        ]);
    }

    #[Computed]
    public function availablePosts()
    {
        $postLimit = (int) ($this->section($this->slug)?->meta('custom.post_limit', 3));

        return $this->latestPosts($postLimit);
    }
}
