<?php

namespace Paparee\BaleDindik\Livewire\LandingPage\Event;

use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Paparee\BaleEmperan\Models\Section;

#[Layout('bale-dindik::layouts.app')]
class EventList extends Component
{
    #[Url]
    public $search = '';

    #[Url]
    public $date = '';

    #[Computed]
    public function rawData()
    {
        $section = Section::whereSlug('event-announcement-section')->first();
        return $section && isset($section->content['items']) ? collect($section->content['items']) : collect([]);
    }

    #[Computed]
    public function events()
    {
        $query = $this->rawData();

        // Filter by Search
        if ($this->search) {
            $query = $query->filter(function ($item) {
                return stripos($item['name'], $this->search) !== false ||
                    stripos($item['description'], $this->search) !== false;
            });
        }

        // Filter by Date
        if ($this->date) {
            if (str_contains($this->date, ' to ')) {
                // Range date
                [$start, $end] = explode(' to ', $this->date);
                $query = $query->filter(function ($item) use ($start, $end) {
                    return $item['date'] >= $start && $item['date'] <= $end;
                });
            } else {
                // Single date
                $query = $query->where('date', $this->date);
            }
        }

        // Default sorting: Ascending by date
        return $query->sortBy('date')->values();
    }

    #[Computed]
    public function groupedEvents()
    {
        // Group by Month Year, e.g., "January 2025"
        return $this->events()->groupBy(function ($item) {
            return Carbon::parse($item['date'])->format('F Y');
        });
    }

    #[Computed]
    public function upcomingEvents()
    {
        return $this->rawData()
            ->filter(function ($item) {
                return $item['date'] >= now()->toDateString();
            })
            ->sortBy('date') // Nearest first
            ->take(5)
            ->values();
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.event.event-list');
    }
}
