<?php

namespace Paparee\BaleDindik\Livewire\LandingPage\Hero;

use Livewire\Component;
use Livewire\Attributes\{Computed, Layout};
use Bale\Emperan\Models\Section;

#[Layout('bale-dindik::layouts.app')]
class Index extends Component
{
    public string $slug = 'hero-section';
    public array $hero = [];

    public function mount(?string $slug = null)
    {
        if ($slug) {
            $this->slug = $slug;
        }

        $section = Section::whereSlug($this->slug)->first();

        $this->hero = $section?->content ?? [];
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.hero.index');
    }

    #[Computed]
    public function meta()
    {
        return $this->hero['meta'] ?? [];
    }

    #[Computed]
    public function items()
    {
        return $this->hero['items'] ?? [];
    }
}