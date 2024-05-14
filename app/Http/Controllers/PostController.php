<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('post.create', compact('categories', 'tags'));
    }


    public function store()
    {
        $data = \request()->validate([
            'title' => 'required|string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);


        $post = Post::create($data);

        $post->tags()->attach($tags);

        return redirect()->route('post.index');
    }


    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }


    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();


        return view('post.edit', compact('post', 'categories', 'tags'));
    }


    public function update(Post $post)
    {
        $data = \request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->sync($tags);
        return redirect()->route('post.show', $post->id);
    }


    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }


    public function delete()
    {
        $post = Post::withTrashed()->find(2);
        $post->restore();
        dd('deleted successfully');
    }


    public function firstOrCreate()
    {
        $anotherPost = [
            'title' => 'some title',
            'content' => 'some another content for this post',
            'image' => 'some updated posts image',
            'likes' => 1034,
            'is_published' => 1,
        ];

        $post = Post::firstOrCreate([
            'title' => 'some title for this post'
        ], [
            'title' => 'some title for this post',
            'content' => 'some another content for this post',
            'image' => 'some updated posts image',
            'likes' => 1034,
            'is_published' => 1,
        ]);

        dump($post->content);
        dd('Finished jies');
    }


    public function updateOrCreate()
    {
        $anotherPost = [
            'title' => 'new some title for this post',
            'content' => 'new updateOrCreate some another content for this post',
            'image' => 'new updateOrCreate some updated posts image',
            'likes' => 763,
            'is_published' => 0,
        ];

        $post = Post::updateOrCreate([
            'title' => 'new some title for this post'
        ], $anotherPost);

        dump($post->title, $post->likes);
        dd('finished');
    }
}
