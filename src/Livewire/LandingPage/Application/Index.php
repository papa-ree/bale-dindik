<?php

namespace Bale\BaleDindik\Livewire\LandingPage\Application;

use Bale\Umpak\Livewire\UmpakComponent;
use Illuminate\Support\Facades\Blade;
use Livewire\Attributes\Computed;

class Index extends UmpakComponent
{
    public string $slug = 'application-section';

    public function mount(?string $slug = null): void
    {
        if ($slug) {
            $this->slug = $slug;
        }
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.application.index', [
            'section' => $this->section($this->slug),
        ]);
    }

    #[Computed]
    public function availableApps()
    {
        $items = $this->section($this->slug)?->items ?? [];

        return collect($items)->map(function ($item) {
            if (!empty($item['icon'])) {
                $iconName = $item['icon'];
                try {
                    $item['icon_svg'] = Blade::render(
                        "<x-lucide-$iconName class='w-6 h-6' />"
                    );
                } catch (\Exception $e) {
                    $item['icon_svg'] = null;
                }
            }
            return $item;
        })->values();
    }

    #[Computed]
    public function availableCategories()
    {
        $categories = ['All'];

        foreach ($this->section($this->slug)?->items ?? [] as $item) {
            if (!empty($item['category']) && !in_array($item['category'], $categories)) {
                $categories[] = $item['category'];
            }
        }

        return $categories;
    }
}
