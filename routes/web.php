<?php

use Illuminate\Support\Facades\Route;
use Bale\BaleDindik\Livewire\Index;
use Bale\BaleDindik\Livewire\LandingPage\Event\EventList;
use Bale\BaleDindik\Livewire\LandingPage\Page\Index as PageIndex;
use Bale\BaleDindik\Livewire\LandingPage\Post\PostList;
use Bale\BaleDindik\Livewire\LandingPage\Post\Show as PostShow;

Route::middleware(['web'])->group(function () {
    Route::get('/', Index::class)->name('index');

    Route::name('bale-dindik.')->group(function () {
        Route::get('page/{slug}', PageIndex::class)->name('page.show');
        Route::get('posts', PostList::class)->name('post.index');
        Route::get('post/{slug}', PostShow::class)->name('post.show');
        Route::get('event-lists', EventList::class)->name('event.index');
    });
});
