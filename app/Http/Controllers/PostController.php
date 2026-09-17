<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Inertia\Response;

class PostController extends Controller
{
    public function index(): Response
    {
        $posts = Post::with(['user', 'comments.user'])->latest()->get();
        return Inertia::render('Posts/Index', ['posts' => $posts]);
    }

    public function create(): Response
    {
        return Inertia::render('Posts/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $request->user()->posts()->create($validated);

        return redirect()->route('posts.index');
    }

    public function show($id): Response
    {
        $post = Post::with(['user', 'comments.user'])->findOrFail($id);
        return Inertia::render('Posts/Show', ['post' => $post]);
    }

    public function edit($id): Response
    {
        $post = Post::findOrFail($id);

        return Inertia::render('Posts/Edit', ['post' => $post]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $post = Post::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($validated);

        return redirect()->route('posts.show', $post->id);
    }

    public function destroy($id): RedirectResponse
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect()->route('posts.index');
    }
}
