<?php

namespace Paparee\BaleDindik\Livewire\SharedComponents;

use Livewire\Component;
use Livewire\Attributes\{Layout};

#[Layout('bale-dindik::layouts.app')]
class Topbar extends Component
{
    public function render()
    {
        return view('bale-dindik::livewire.shared-components.topbar');
    }
}