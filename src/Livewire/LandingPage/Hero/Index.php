<?php

namespace Paparee\BaleDindik\Livewire\LandingPage\Hero;

use Livewire\Component;
use Livewire\Attributes\{Layout};
use Bale\Emperan\Models\Section;

#[Layout('bale-dindik::layouts.app')]
class Index extends Component
{
    public array $hero = [];

    public function mount()
    {
        $section = Section::whereSlug('hero-section')->first();

        $section->visit();

        $this->hero = $section?->content ?? [];
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.hero.index');
    }
}