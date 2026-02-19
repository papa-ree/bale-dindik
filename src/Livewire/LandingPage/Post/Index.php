<?php

namespace Paparee\BaleDindik\Livewire\LandingPage\Post;

use Livewire\Component;
use Livewire\Attributes\{Computed, Layout};
use Bale\Emperan\Models\Post;
use Bale\Emperan\Models\Section;

#[Layout('bale-dindik::layouts.app')]
class Index extends Component
{
    public string $slug = 'post-section';
    public array $section = [];
    public $actived;

    public function mount(?string $slug = null)
    {
        if ($slug) {
            $this->slug = $slug;
        }

        $section = Section::whereSlug($this->slug)->first();

        $this->actived = $section?->actived;

        $this->section = $section?->content ?? [];
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.post.index');
    }

    #[Computed]
    public function meta()
    {
        return $this->section['meta'] ?? [];
    }

    #[Computed]
    public function items()
    {
        return $this->section['items'] ?? [];
    }

    #[Computed]
    public function availablePosts()
    {
        $postLimit = $this->meta['custom']['post_limit'] ?? 3;
        return Post::latest()->wherePublished(true)->take($postLimit)->get();
    }
}