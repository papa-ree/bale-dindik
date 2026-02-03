<?php

namespace Paparee\BaleDindik\Livewire\LandingPage\Footer;

use Livewire\Component;
use Livewire\Attributes\{Computed, Layout};
use Bale\Emperan\Models\Section;
use Bale\Emperan\Models\HeroSection;

#[Layout('bale-dindik::layouts.app')]
class Index extends Component
{
    public array $footer = [];

    public function mount()
    {
        $section = Section::whereSlug('footer-section')->first();

        $this->footer = $section?->content ?? [];
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.footer.index');
    }

    #[Computed]
    public function about()
    {
        return Section::whereSlug('hero-section')->first();
    }

    #[Computed]
    public function availableItems()
    {
        $items = $this->footer['meta'] ?? [];

        return $items;
    }
}