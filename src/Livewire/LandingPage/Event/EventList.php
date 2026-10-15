<?php

namespace Bale\BaleDindik\Livewire\LandingPage\Event;

use Bale\Umpak\Livewire\UmpakComponent;
use Livewire\Attributes\{Computed, Layout, Url};

#[Layout('bale-dindik::layouts.app')]
class EventList extends UmpakComponent
{
    #[Url]
    public string $search = '';

    #[Url]
    public string $date = '';

    #[Computed]
    public function events()
    {
        $events = $this->latestAgendas(1000);

        // Filter by Search (D-9 opsi b: filter koleksi di PHP)
        if ($this->search !== '') {
            $needle = strtolower($this->search);

            $events = $events->filter(function ($agenda) use ($needle) {
                return str_contains(strtolower($agenda->title), $needle)
                    || str_contains(strtolower((string) $agenda->description), $needle);
            });
        }

        // Filter by Date: menjangkau tanggal berapapun (termasuk masa lalu),
        // urut kronologis naik.
        if ($this->date !== '') {
            if (str_contains($this->date, ' to ')) {
                // Range date
                [$start, $end] = explode(' to ', $this->date);

                $events = $events->filter(function ($agenda) use ($start, $end) {
                    $date = $agenda->startDate->toDateString();

                    return $date >= $start && $date <= $end;
                });
            } else {
                // Single date
                $events = $events->filter(
                    fn ($agenda) => $agenda->startDate->toDateString() === $this->date
                );
            }

            return $events->sortBy(fn ($agenda) => $agenda->startDate)->values();
        }

        // Default: sembunyikan agenda masa lalu, mulai dari hari ini ke atas.
        $today = now()->startOfDay();

        return $events
            ->filter(fn ($agenda) => $agenda->startDate->gte($today))
            ->sortBy(fn ($agenda) => $agenda->startDate)
            ->values();
    }

    #[Computed]
    public function groupedEvents()
    {
        // Group by Month Year, e.g., "January 2025"
        return $this->events->groupBy(
            fn ($agenda) => $agenda->startDate->translatedFormat('F Y')
        );
    }

    #[Computed]
    public function upcomingEvents()
    {
        return $this->upcomingAgendas(5);
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.event.event-list');
    }
}
