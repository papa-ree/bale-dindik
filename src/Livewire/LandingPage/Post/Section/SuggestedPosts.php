<?php

namespace Bale\BaleDindik\Livewire\LandingPage\Post\Section;

use Bale\Umpak\Livewire\UmpakComponent;
use Livewire\Attributes\Computed;

class SuggestedPosts extends UmpakComponent
{
    #[Computed]
    public function suggestedPosts()
    {
        return $this->getRandomPosts(5);
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.post.section.suggested-posts');
    }
}
