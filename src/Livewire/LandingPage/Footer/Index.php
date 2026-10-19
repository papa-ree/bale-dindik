<?php

namespace Bale\BaleDindik\Livewire\LandingPage\Footer;

use Bale\Umpak\Livewire\UmpakComponent;
use Illuminate\Support\Facades\Blade;
use Livewire\Attributes\{Computed};

class Index extends UmpakComponent
{
    public string $slug = 'footer-section';

    public function mount(?string $slug = null): void
    {
        if ($slug) {
            $this->slug = $slug;
        }
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.footer.index', [
            'section' => $this->section($this->slug),
        ]);
    }

    #[Computed]
    public function meta()
    {
        return $this->section($this->slug)?->meta ?? [];
    }

    /**
     * Get organization info from hero-section for the About column.
     */
    #[Computed]
    public function about()
    {
        return $this->section('hero-section')?->meta ?? [];
    }

    /**
     * Parse the raw items array from the database into structured groups.
     *
     * Dua bentuk data yang didukung:
     *
     * 1. Grup per baris (CMS terbaru) — satu item = satu tautan/kontak:
     *      { grup: "quick link", url: "/", nama: "beranda", value: "Beranda", icon: "…" }
     *      { grup: "kontak", url: "mailto:x@y.com", nama: "email", value: "x@y.com" }
     *      { grup: "social", sm_facebook: ["https://facebook.com/x"], sm_instagram: ["…"] }
     *
     * 2. Legacy — satu item memuat semua grup sebagai key:
     *      { "quick link": ["home_link:home", "home_url:/", …], "contact": ["email: …"], "facebook": ["https://…"] }
     *
     * Returns structured data:
     *   "quick_link" => [["label" => "Beranda", "url" => "/"], …]
     *   "contact"    => [["type" => "email", "value" => "x@y.com"], …]
     *   "social"     => [["name" => "Facebook", "url" => "https://…", "icon" => "<svg…>"], …]
     */
    #[Computed]
    public function parsedItems(): array
    {
        $items = $this->sectionItems();

        if (empty($items)) {
            return [];
        }

        return isset($items[0]['grup'])
            ? $this->parseGroupedItems($items)
            : $this->parseLegacyItems($items);
    }

    /**
     * Items section sebagai baris, dengan nilai yang datang terbungkus array
     * satu elemen dari CMS (["beranda"] → "beranda") sudah diratakan.
     *
     * @return array<int, array<string, mixed>>
     */
    private function sectionItems(): array
    {
        $items = $this->section($this->slug)?->items ?? [];

        return collect($items)
            ->filter(fn ($item) => is_array($item))
            ->map(fn (array $item) => collect($item)
                ->map(fn ($value) => $this->unwrapValue($value))
                ->all())
            ->values()
            ->all();
    }

    /**
     * Ratakan hanya array satu elemen berisi skalar; array lain (mis. daftar
     * "quick link" pada format legacy) dibiarkan utuh.
     */
    private function unwrapValue(mixed $value): mixed
    {
        while (is_array($value) && count($value) === 1 && is_scalar(reset($value))) {
            $value = reset($value);
        }

        return $value;
    }

    /**
     * Format baru: tiap baris punya grup sendiri ("quick link" / "kontak" / "social").
     *
     * @param  array<int, array<string, mixed>>  $items
     * @return array<string, array<int, array<string, mixed>>>
     */
    private function parseGroupedItems(array $items): array
    {
        $quickLinks = [];
        $contacts = [];
        $socials = [];

        foreach ($items as $item) {
            $group = strtolower($this->text($item['grup'] ?? ''));

            if (in_array($group, ['quick link', 'quicklink', 'quick_link', 'menu'], true)) {
                $label = $this->text($item['value'] ?? '') ?: $this->text($item['nama'] ?? '');
                $url = $this->text($item['url'] ?? '');

                if ($label === '' && $url === '') {
                    continue;
                }

                $quickLinks[] = [
                    'label' => $label !== '' ? $label : $url,
                    'url' => $url !== '' ? $url : '#',
                    'icon' => $this->text($item['icon'] ?? ''),
                    'icon_svg' => $this->linkIcon($this->text($item['icon'] ?? '')),
                ];

                continue;
            }

            if (in_array($group, ['kontak', 'contact'], true)) {
                $type = $this->contactType($this->text($item['nama'] ?? ''));

                $contacts[] = [
                    'type' => $type,
                    'value' => $this->text($item['value'] ?? ''),
                    'url' => $this->text($item['url'] ?? ''),
                    'icon' => $this->text($item['icon'] ?? ''),
                    'icon_svg' => $this->contactIcon($this->text($item['icon'] ?? ''), $type),
                ];

                continue;
            }

            if ($group === 'social') {
                foreach ($item as $key => $values) {
                    if (is_string($key) && str_starts_with($key, 'sm_')) {
                        $socials = array_merge($socials, $this->buildSocials($this->socialPlatformKey($key), $values));
                    }
                }
            }
        }

        return ['quick_link' => $quickLinks, 'contact' => $contacts, 'social' => $socials];
    }

    /**
     * Format legacy: semua grup berada di dalam satu item.
     *
     * @param  array<int, array<string, mixed>>  $items
     * @return array<string, array<int, array<string, mixed>>>
     */
    private function parseLegacyItems(array $items): array
    {
        $item = $items[0] ?? [];

        // --- Quick Links --- ("nama_link: label" dipasangkan dengan "nama_url: url")
        $quickLinks = [];
        $tempLabels = [];

        foreach ((array) ($item['quick link'] ?? []) as $entry) {
            if (!is_string($entry) || !str_contains($entry, ':')) {
                continue;
            }

            [$key, $value] = explode(':', $entry, 2);
            $key = trim($key);
            $value = trim($value);

            if (str_ends_with($key, '_link')) {
                $tempLabels[str_replace('_link', '', $key)] = $value;
            } elseif (str_ends_with($key, '_url')) {
                $name = str_replace('_url', '', $key);
                $quickLinks[] = [
                    'label' => $tempLabels[$name] ?? $name,
                    'url' => $value,
                    'icon_svg' => $this->linkIcon(''),
                ];
            }
        }

        // --- Contact ---
        $contacts = [];
        foreach ((array) ($item['contact'] ?? []) as $entry) {
            if (!is_string($entry) || !str_contains($entry, ':')) {
                if (is_string($entry) && $entry !== '') {
                    $contacts[] = ['type' => 'info', 'value' => $entry, 'icon_svg' => $this->contactIcon('', 'info')];
                }

                continue;
            }

            [$type, $value] = explode(':', $entry, 2);
            $type = $this->contactType($type);
            $contacts[] = ['type' => $type, 'value' => trim($value), 'icon_svg' => $this->contactIcon('', $type)];
        }

        // --- Social Media --- (key di luar daftar field item = platform)
        $socials = [];
        $fieldKeys = [
            'id', 'nama', 'value', 'grup', 'icon', 'url', 'uploads', 'attachments',
            'created_at', 'updated_at', 'quick link', 'contact',
        ];

        foreach ($item as $key => $values) {
            if (!is_string($key) || in_array(strtolower($key), $fieldKeys, true)) {
                continue;
            }

            $socials = array_merge($socials, $this->buildSocials($this->socialPlatformKey($key), $values));
        }

        return ['quick_link' => $quickLinks, 'contact' => $contacts, 'social' => $socials];
    }

    /**
     * Entri sosial (nama + icon dari config umpak.social-media) untuk satu platform.
     *
     * @return array<int, array<string, mixed>>
     */
    private function buildSocials(string $platformKey, mixed $urls): array
    {
        $config = config('umpak.social-media', [])[$platformKey] ?? null;
        $socials = [];

        foreach ((array) $urls as $url) {
            if (!is_string($url) || !filter_var($url, FILTER_VALIDATE_URL)) {
                continue;
            }

            $socials[] = [
                'key' => $platformKey,
                'name' => $config['name'] ?? ucfirst($platformKey),
                'url' => $url,
                'icon' => $config['icon'] ?? null,
                'color' => $config['color'] ?? null,
            ];
        }

        return $socials;
    }

    /**
     * Key sosial CMS: "sm_facebook" (format baru) atau "facebook" (legacy).
     */
    private function socialPlatformKey(string $key): string
    {
        $key = strtolower(trim($key));

        return str_starts_with($key, 'sm_') ? substr($key, 3) : $key;
    }

    /**
     * Icon tautan: pakai nama icon dari CMS, fallback chevron bila nama itu
     * tidak tersedia di set icon yang terpasang.
     */
    private function linkIcon(string $name): ?string
    {
        return $this->renderIcon($name, 'w-4 h-4') ?? $this->renderIcon('chevron-right', 'w-4 h-4');
    }

    /**
     * Icon kontak: pakai nama icon dari CMS, fallback berdasarkan tipe kontak.
     */
    private function contactIcon(string $name, string $type): ?string
    {
        return $this->renderIcon($name, 'w-4 h-4') ?? $this->renderIcon($this->defaultContactIcon($type), 'w-4 h-4');
    }

    private function defaultContactIcon(string $type): string
    {
        return match ($type) {
            'email' => 'mail',
            'phone' => 'phone',
            'address' => 'map-pin',
            default => 'info',
        };
    }

    /**
     * Render icon lucide menjadi SVG.
     *
     * Nama icon dari CMS divalidasi ke huruf/angka/tanda hubung saja supaya
     * tidak bisa menyuntikkan markup lewat Blade::render().
     */
    private function renderIcon(string $name, string $class): ?string
    {
        $name = strtolower(trim($name));

        if (!preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $name)) {
            return null;
        }

        try {
            return Blade::render('<x-lucide-' . $name . ' class="' . $class . '" />');
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * Samakan label kontak CMS dengan tipe yang dipakai view (email/phone/address)
     * supaya ikon dan tautan (mailto:/tel:) tepat.
     */
    private function contactType(string $name): string
    {
        return match (strtolower(trim($name))) {
            'email', 'e-mail', 'surel' => 'email',
            'phone', 'telp', 'telpon', 'telepon', 'whatsapp', 'wa' => 'phone',
            'address', 'alamat', 'lokasi', 'maps' => 'address',
            default => 'info',
        };
    }

    /**
     * Ubah nilai item CMS menjadi teks: skalar apa adanya, array satu elemen
     * dibuka, struktur lain (EditorJS) dirangkai dari nilai teksnya.
     */
    private function text(mixed $value): string
    {
        if (is_array($value)) {
            if (count($value) === 1) {
                return $this->text(reset($value));
            }

            $texts = [];
            array_walk_recursive($value, function ($v) use (&$texts) {
                if (is_scalar($v)) {
                    $texts[] = (string) $v;
                }
            });

            return trim(implode(' ', $texts));
        }

        return is_scalar($value) ? trim((string) $value) : '';
    }
}
