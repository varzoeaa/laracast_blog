<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;


Route::get('/', function () {
    return view('posts', [
        'posts' -> Post::allPosts()
    ]); 
});

Route::get('posts/{post}', function ($slug) {
    return view ('post', [
        'post' ->  Post::findorFail($slug)
    ]);
});