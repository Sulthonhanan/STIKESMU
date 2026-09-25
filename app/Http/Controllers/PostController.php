<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::where('is_published', true)->with('user');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%')
                  ->orWhere('body', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $posts = $query->latest()->paginate(9)->withQueryString();

        return view('posts.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('is_published', true)
            ->with('user')
            ->firstOrFail();

        $recentPosts = Post::where('is_published', true)
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(4)
            ->get();

        return view('posts.show', compact('post', 'recentPosts'));
    }
}
