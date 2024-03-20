<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post extends Model
{
    use HasFactory;

    public $title;
    public $excerpt;
    public $date;
    public $slug;
    public $body;

    public function __construct($title, $excerpt, $date, $slug, $body) {
        $this->title->$title;
        $this->excerpt->$excerpt;
        $this->date->$date;
        $this->slug->$slug;
        $this->body->$body;
    }

    public function allPosts() {

        return cache()->rememberForever('posts.all', function () {
            return collect(File::files(resource_path("posts")))
        ->map(function ($file) {
            return YamlFrontMatter::parseFile($file);
        
        })
        ->map(function ($document){
            return new Post(
                $document->title,
                $document->excerpt,
                $document->date,
                $document->slug,
                $document->body(),
    
            );
        })
        ->sortByDesc('date');
        });
        
    }

    public function find($slug) {
    
    return static::allPosts()->firstWhere('slug', $slug);
    
    }

    public function findorFail($slug) {

        $post = static::find($slug);
    
        if (!$post) {
            throw new ModelNotFoundException;
        } 
    
        return $post;
    
        }
}
