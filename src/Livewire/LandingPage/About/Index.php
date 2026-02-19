<?php

namespace Paparee\BaleDindik\Livewire\LandingPage\About;

use Livewire\Component;
use Livewire\Attributes\{Computed, Layout};
use Bale\Emperan\Models\Section;

#[Layout('bale-dindik::layouts.app')]
class Index extends Component
{
    public string $slug = 'about-section';
    public array $section = [];
    public $actived;

    public function mount(?string $slug = null)
    {
        if ($slug) {
            $this->slug = $slug;
        }

        $sectionModel = Section::whereSlug($this->slug)->first();

        $this->section = $sectionModel?->content ?? [];
        $this->actived = $sectionModel?->actived;
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.about.index');
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
}