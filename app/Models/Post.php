<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post
{
    public static function all()
    {
        $files = File::files(resource_path("posts/"));

        return array_map(fn($file) => $file->getContents(), $files);

        // return File::files(resource_path("posts/"));
    }
    public static function find($slug)
    {
        // $path = __DIR__ . "/../resources/posts/{$slug}.html";
        // base_path();
        // if (! file_exists($path = __DIR__ . "/../resources/posts/{$slug}.html")) {     // also can do this
        // if you couldn't find the post -> throw
        if (!file_exists($path = resource_path("posts/{$slug}.html"))) {     // also can do this
            throw new ModelNotFoundException();
            // if (! file_exists($path)) {
            // option1 : show error message
            // ddd('file does not exist');
            // dd('file does not exist');
            // option2 : show 404 error
            // abort(404);
            // option3 : send back to homepage
            // return redirect('/');
        }
        // cache for 20minutes
        return $post = cache()->remember("posts.{$slug}", 1200, function () use ($path) {
            // var_dump('file_get_contents');
            return file_get_contents($path);
            // $post = file_get_contents($path);
        });
    }
}
