<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Paparee\BaleDindik\Livewire\Index;
use Paparee\BaleDindik\Livewire\LandingPage\Event\EventList;
use Paparee\BaleDindik\Livewire\LandingPage\Page\Index as PageIndex;
use Paparee\BaleDindik\Livewire\LandingPage\Post\Index as PostIndex;
use Paparee\BaleDindik\Livewire\LandingPage\Post\PostList;
use Paparee\BaleDindik\Livewire\LandingPage\Post\Show as PostShow;

Route::middleware(['web'])->group(function () {
    Route::get('/', Index::class)->name('index');

    Route::name('bale.')->group(function () {
        Route::get('page/{page}', PageIndex::class)->name('view-page');
        Route::get('posts', PostList::class)->name('post-list');
        Route::get('post/{post}', PostShow::class)->name('view-post');
        Route::get('event-lists', EventList::class)->name('event-list');
    });
});