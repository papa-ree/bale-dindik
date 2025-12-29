<?php

namespace Paparee\BaleDindik\Livewire\LandingPage\FeaturedProgram;

use Livewire\Component;
use Livewire\Attributes\{Layout};
use Paparee\BaleEmperan\Models\Section;

#[Layout('bale-dindik::layouts.app')]
class Index extends Component
{
    public array $section = [];

    public function mount()
    {
        $section = Section::whereSlug('featured-program-section')->first();

        $this->section = $section?->content ?? [];
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.featured-program.index');
    }
}