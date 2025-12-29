<?php

namespace Paparee\BaleDindik\Livewire\LandingPage\Post;

use Livewire\Component;
use Livewire\Attributes\{Computed, Layout};
use Paparee\BaleEmperan\Models\Post;

#[Layout('bale-dindik::layouts.app')]
class PostList extends Component
{
    public int $amount = 6;

    public function loadMore()
    {
        $this->amount += 6;
    }

    #[Computed]
    public function posts()
    {
        return Post::latest()->wherePublished(true)->take($this->amount)->get();
    }

    #[Computed]
    public function hasMore()
    {
        return Post::wherePublished(true)->count() > $this->amount;
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.post.post-list');
    }
}
