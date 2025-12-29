<?php

namespace Paparee\BaleDindik\Livewire\LandingPage\Post;

use Livewire\Component;
use Livewire\Attributes\{Computed, Layout};
use Bale\Emperan\Models\Post;
use Bale\Emperan\Models\Section;

#[Layout('bale-dindik::layouts.app')]
class Index extends Component
{
    public array $section = [];

    public function mount()
    {
        $section = Section::whereSlug('post-section')->first();

        $this->section = $section?->content ?? [];
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.post.index');
    }

    #[Computed]
    public function availablePosts()
    {
        return Post::latest()->wherePublished(true)->take($this->section['layouts']['post_limit'])->get();
    }
}