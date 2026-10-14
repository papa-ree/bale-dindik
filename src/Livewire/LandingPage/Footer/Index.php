<?php

namespace Bale\BaleDindik\Livewire\LandingPage\Footer;

use Bale\Umpak\Livewire\UmpakComponent;
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
     * Raw format (all values are arrays of "key:value" or plain URL strings):
     *   "quick link": ["home_link:home", "home_url:/", "post_link:berita", "post_url:/posts", ...]
     *   "contact":    ["email:cms@bale.id", "phone:+62 352 481234", "address:Jl. Soekarno Hatta 123"]
     *   "facebook":   ["https://facebook.com"]
     *   "instagram":  ["https://instagram.com"]
     *
     * Returns structured data:
     *   "quick_link" => [["label" => "home", "url" => "/"], ...]
     *   "contact"    => [["type" => "email", "value" => "cms@bale.id"], ...]
     *   "social"     => [["name" => "Facebook", "url" => "https://facebook.com"], ...]
     */
    #[Computed]
    public function parsedItems()
    {
        $raw = $this->section($this->slug)?->items ?? [];

        if (empty($raw)) {
            return [];
        }

        // Items is stored as an array with one object
        $item = $raw[0] ?? $raw;

        $result = [];

        // --- Quick Links ---
        $quickLinkRaw = $item['quick link'] ?? [];
        $quickLinks = [];
        $tempLabels = [];

        foreach ($quickLinkRaw as $entry) {
            if (!str_contains($entry, ':'))
                continue;
            [$key, $value] = explode(':', $entry, 2);
            $key = trim($key);
            $value = trim($value);

            if (str_ends_with($key, '_link')) {
                $name = str_replace('_link', '', $key);
                $tempLabels[$name] = $value;
            } elseif (str_ends_with($key, '_url')) {
                $name = str_replace('_url', '', $key);
                $label = $tempLabels[$name] ?? $name;
                $quickLinks[] = ['label' => $label, 'url' => $value];
            }
        }
        $result['quick_link'] = $quickLinks;

        // --- Contact ---
        $contactRaw = $item['contact'] ?? [];
        $contacts = [];
        foreach ($contactRaw as $entry) {
            if (!str_contains($entry, ':')) {
                $contacts[] = ['type' => 'info', 'value' => $entry];
                continue;
            }
            [$type, $value] = explode(':', $entry, 2);
            $contacts[] = ['type' => trim($type), 'value' => trim($value)];
        }
        $result['contact'] = $contacts;

        // --- Social Media (using config for name & icon) ---
        $socialConfig = config('umpak.social-media', []);
        $knownKeys = ['quick link', 'contact', 'id', 'created_at', 'updated_at'];
        $socials = [];
        foreach ($item as $key => $values) {
            if (in_array($key, $knownKeys) || !is_array($values))
                continue;
            foreach ($values as $url) {
                if (!filter_var($url, FILTER_VALIDATE_URL))
                    continue;
                $platformKey = strtolower(trim($key));
                $platformCfg = $socialConfig[$platformKey] ?? null;
                $socials[] = [
                    'key' => $platformKey,
                    'name' => $platformCfg['name'] ?? ucfirst($platformKey),
                    'url' => $url,
                    'icon' => $platformCfg['icon'] ?? null,
                    'color' => $platformCfg['color'] ?? null,
                ];
            }
        }
        $result['social'] = $socials;

        return $result;
    }
}
