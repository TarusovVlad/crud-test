<?php

namespace App\Http\Controllers;

use App\Http\Actions\PostAction;
use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * @var \App\Http\Actions\PostAction $postAction
     */
    protected PostAction $postAction;

    public function __construct(PostAction $postAction)
    {
        $this->postAction = $postAction;
    }

    /**
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): Renderable
    {
        $user = Auth::user();
        $posts = $this->postAction->loadPosts();

        return view('home', ['posts' => $posts, 'userId' => $user->id]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('posts.create');
    }

    /**
     * @param  \App\Http\Requests\PostStoreRequest $postStoreRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostStoreRequest $postStoreRequest): RedirectResponse
    {
        $user = Auth::user();
        $this->postAction->storePost($user->id, $postStoreRequest->getPostTitle(), $postStoreRequest->getPostContent());

        return redirect()->route('home')->with('success', 'Post has been created successfully.');
    }

    /**
     * @param \App\Models\Post $post
     * @return \Illuminate\View\View
     */
    public function show(Post $post): View
    {
        return view('posts.show', compact('post'));
    }

    /**
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Post $post): RedirectResponse|View
    {
        $user = Auth::user();

        if ($user->id !== $post->user_id) {
            return redirect()->back();
        }

        return view('posts.edit',compact('post'));
    }

    /**
     * @param \App\Http\Requests\PostStoreRequest $postStoreRequest
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostStoreRequest $postStoreRequest, Post $post)
    {
        $user = Auth::user();

        if ($user->id !== $post->user_id) {
            return redirect()->back();
        }

        $this->postAction->updatePost($post, $postStoreRequest->getPostTitle(), $postStoreRequest->getPostContent());

        return redirect()->route('home')->with('success','Post Has Been updated successfully');
    }

    /**
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->postAction->deletePost($post);

        return redirect()->route('home')->with('success','Post has been deleted successfully');
    }
}
