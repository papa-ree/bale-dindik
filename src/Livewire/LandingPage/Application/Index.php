<?php

namespace Bale\BaleDindik\Livewire\LandingPage\Application;

use Bale\Umpak\Livewire\UmpakComponent;
use Illuminate\Support\Collection;
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
        return $this->sectionItems()->map(function (array $item) {
            // Nama icon dari CMS bisa saja tidak tersedia di set icon;
            // jatuh ke icon umum agar kartu tidak menampilkan kotak kosong.
            $icon = $item['icon'] ?? null;
            $icon = is_string($icon) && $icon !== '' ? $icon : 'globe';

            $item['icon_svg'] = $this->renderIcon($icon) ?? $this->renderIcon('globe') ?? '';

            return $item;
        })->values();
    }

    #[Computed]
    public function availableCategories()
    {
        $categories = ['All'];

        foreach ($this->sectionItems() as $item) {
            $category = $item['category'] ?? null;

            if (is_string($category) && $category !== '' && !in_array($category, $categories, true)) {
                $categories[] = $category;
            }
        }

        return $categories;
    }

    /**
     * Item section dari CMS menyimpan tiap nilai terbungkus array satu elemen
     * (name: ["siadik"], icon: ["layer"], category: ["website"]). Nilainya
     * diratakan menjadi skalar/teks karena dikirim ke Alpine via @js() —
     * JS memanggil app.name.toLowerCase(), app.category, dst.
     *
     * @return Collection<int, array<string, mixed>>
     */
    private function sectionItems(): Collection
    {
        $items = $this->section($this->slug)?->items ?? [];

        return collect($items)
            ->filter(fn ($item) => is_array($item))
            ->map(fn (array $item) => collect($item)
                ->map(fn ($value) => $this->flattenValue($value))
                ->all())
            ->values();
    }

    /**
     * Ratakan nilai item CMS: array satu elemen (["website"] → "website")
     * maupun struktur EditorJS menjadi teks.
     */
    private function flattenValue(mixed $value): mixed
    {
        while (is_array($value) && count($value) === 1 && is_scalar(reset($value))) {
            $value = reset($value);
        }

        if (!is_array($value)) {
            return $value;
        }

        $texts = [];
        array_walk_recursive($value, function ($v, $k) use (&$texts) {
            if ($k === 'text' && is_string($v)) {
                $texts[] = $v;
            }
        });

        // Bukan struktur EditorJS: pakai nilai skalar apa adanya.
        if ($texts === []) {
            array_walk_recursive($value, function ($v) use (&$texts) {
                if (is_scalar($v)) {
                    $texts[] = (string) $v;
                }
            });
        }

        return trim(implode(' ', $texts));
    }

    private function renderIcon(string $name): ?string
    {
        try {
            return Blade::render("<x-lucide-$name class='w-6 h-6' />");
        } catch (\Throwable $e) {
            return null;
        }
    }
}
