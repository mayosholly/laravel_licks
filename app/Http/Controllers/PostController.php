<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(){
        // $url = 'https://www.youtube.com/watch?v=dfB0qmJo1eM';
        $url = 'https://www.youtube.com/watch?v=p1uG49yAmBI';

        preg_match(
            '/[\\?\\&]v=([^\\?\\&]+)/',
            $url,
            $matches
        );
        $fullurl = "http://www.youtube.com/embed/".$matches[1];

        $posts = Post::get();
        return view('posts/index', [
            'posts' => $posts,
            'fullurl' => $fullurl
        ]);
    }

    public function create(){
        return view('posts/create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'image' => 'required'
        ]);

        $post = new Post($request->except('image'));
        if($request->hasFile('image')){
            $image = $request->file('image')->store('post_images');
            $post->image = $image;
            if($image){
                $post->setAttribute('image', $image);
            }
        }
        $post->save();
        return redirect()->route('post.index');
    }

    public function edit(Post $post){
        return view('posts/edit', [
            'post' => $post
        ]);
    }

    public function update(Post $post, Request $request){
        $request->validate([
            'title' => 'required',
            'image' => 'nullable'
        ]);
        $post->fill($request->except('image'));
        if($request->hasFile('image')){
            Storage::delete($post->getRawOriginal('image'));
            $image = $request->file('image')->store('post_images');
            $post->image = $image;
            if($image){
                $post->setAttribute('image', $image);
            }
        $post->save();
        }
        return redirect()->route('post.index');
    }

    public function destroy(Post $post){
        $post->delete();
        Storage::delete($post->getRawOriginal('image'));
        return redirect()->route('post.index');
    }

    public function downloadFile(Post $post){
        return Storage::disk('public')->download($post->getRawOriginal('image'));
    }


}
