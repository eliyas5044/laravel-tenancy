<?php

namespace App\Http\Controllers\Tenancy;

use App\Http\Controllers\Controller;
use App\Models\Tenancy\Post;
use App\Models\Tenancy\User;
use App\Notifications\PostPublished;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Tenancy/Post', [
            'posts' => Post::with('user')->latest()->get(),
            'status' => session('status'),
            'error' => session('error'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Tenancy/PostEntry');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $request->merge([
                'user_id' => auth()->id(),
            ]);
            Post::query()->create($request->all());

            return Redirect::route('post.index')->with('status', 'Successfully Created!');
        } catch (Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Tenancy\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Tenancy\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tenancy\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Tenancy\Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $post->delete();

            return back()->with('status', 'Successfully Deleted!');
        } catch (Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function publish(Request $request, Post $post): RedirectResponse
    {
        $this->authorize('publish-post');
        DB::beginTransaction();
        try {
            $post->update([
                'status' => $request->input('status')
            ]);
            // notify post author
            $author = User::find($post->user_id);
            $author->notify(new PostPublished($post));

            return back()->with('status', 'Successfully Updated!');
        } catch (Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
