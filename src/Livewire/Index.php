<?php

namespace Bale\BaleDindik\Livewire;

use Bale\Umpak\Livewire\UmpakComponent;
use Livewire\Attributes\{Layout};

#[Layout('bale-dindik::layouts.app')]
class Index extends UmpakComponent
{
    public function render()
    {
        return view('bale-dindik::livewire.index');
    }
}
