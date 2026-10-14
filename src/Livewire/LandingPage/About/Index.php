<?php

namespace Bale\BaleDindik\Livewire\LandingPage\About;

use Bale\Umpak\Livewire\UmpakComponent;

class Index extends UmpakComponent
{
    public string $slug = 'about-section';

    public function mount(?string $slug = null): void
    {
        if ($slug) {
            $this->slug = $slug;
        }
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.about.index', [
            'section' => $this->section($this->slug),
        ]);
    }
}
