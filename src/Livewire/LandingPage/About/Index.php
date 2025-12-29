<?php

namespace Paparee\BaleDindik\Livewire\LandingPage\About;

use Livewire\Component;
use Livewire\Attributes\{Layout};
use Bale\Emperan\Models\Section;

#[Layout('bale-dindik::layouts.app')]
class Index extends Component
{
    public array $meta = [];
    public array $items = [];

    public function mount()
    {
        $section = Section::whereSlug('about-section')->first();

        $this->meta = $section?->content['meta'] ?? [];
        $this->items = $section?->content['items'] ?? [];
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.about.index');
    }
}