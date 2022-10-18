<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public $title;

    public $excerpt;

    public $date;

    public $body;

    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }
    public static function all()
    {
        return collect(File::files(resource_path("posts")))
        ->map(fn ($file) => YamlFrontMatter::parseFile($file))
        ->map(fn ($document) => new Post(
            $document->title,
            $document->excerpt,
            $document->date,
            $document->body(),
            $document->slug
        ));

        // return File::files(resource_path("posts/"));
    }
    public static function find($slug)
    {
        return static::all()->firstWhere('slug', $slug);
        // $path = __DIR__ . "/../resources/posts/{$slug}.html";
        // base_path();
        // if (! file_exists($path = __DIR__ . "/../resources/posts/{$slug}.html")) {     // also can do this
        // if you couldn't find the post -> throw
        // if (!file_exists($path = resource_path("posts/{$slug}.html"))) {
            // of all the blog postsm find the one with a slug that matches the one that was requested.

        // dd($posts);
            // also can do this
            // throw new ModelNotFoundException();
            // if (! file_exists($path)) {
            // option1 : show error message
            // ddd('file does not exist');
            // dd('file does not exist');
            // option2 : show 404 error
            // abort(404);
            // option3 : send back to homepage
            // return redirect('/');

        // cache for 20minutes
        // return $post = cache()->remember("posts.{$slug}", 1200, function () use ($path) {
            // var_dump('file_get_contents');
            // return file_get_contents($path);
            // $post = file_get_contents($path);
        // });
    }
}
