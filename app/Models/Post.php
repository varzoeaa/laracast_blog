<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post extends Model
{
    use HasFactory;

    public function find($slug) {

    if (! file_exists($path = resource_path("posts/{$slug}.html"))) {
        throw new ModelNotFoundException;
    }

    return cache()->remember("posts.{$slug}", now()->addMinutes(20), function () use ($path){
        return file_get_contents($path);
    });

    }

    public function all() {
        $files = File::files(resource_path("posts/")) ;

        return array_map(function ($files) {
            return $files -> file_get_contents();
        });
    }
}
