<?php

namespace Paparee\BaleDindik\Livewire\LandingPage\Application;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Livewire\Attributes\{Computed, Layout};
use Paparee\BaleEmperan\Models\Section;

#[Layout('bale-dindik::layouts.app')]
class Index extends Component
{
    public array $section = [];

    public function mount()
    {
        $section = Section::whereSlug('application-section')->first();

        $this->section = $section?->content ?? [];
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.application.index');
    }

    #[Computed]
    public function availableApps()
    {
        $items = $this->section['items'] ?? [];

        return collect($items)->map(function ($item) {
            if (isset($item['icon'])) {
                $iconName = $item['icon'];

                $item['icon_svg'] = Blade::render(
                    "<x-lucide-$iconName class='w-6 h-6' />"
                );
            }

            return $item;
        });
    }

    #[Computed]
    public function availableCategories()
    {
        $categories = ['All'];

        foreach ($this->section['items'] ?? [] as $item) {
            if (!empty($item['category']) && !in_array($item['category'], $categories)) {
                $categories[] = $item['category'];
            }
        }

        return $categories;
    }
}