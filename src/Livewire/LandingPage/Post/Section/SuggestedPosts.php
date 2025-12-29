<?php

namespace Paparee\BaleDindik\Livewire\LandingPage\Post\Section;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Bale\Emperan\Models\Post;

class SuggestedPosts extends Component
{
    public $currentSlug;

    #[Computed]
    public function suggestedPosts()
    {
        return Post::where('slug', '!=', $this->currentSlug)
            ->wherePublished(true)
            ->latest()
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.post.section.suggested-posts');
    }
}
