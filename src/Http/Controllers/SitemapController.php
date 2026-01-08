<?php

namespace Paparee\BaleDindik\Http\Controllers;

use App\Http\Controllers\Controller;
use Bale\Emperan\Models\Page;
use Bale\Emperan\Models\Post;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $pages = Page::all();
        $posts = Post::where('published', true)->get();

        return response()->view('bale-dindik::sitemap', [
            'pages' => $pages,
            'posts' => $posts,
        ])->header('Content-Type', 'text/xml');
    }
}
