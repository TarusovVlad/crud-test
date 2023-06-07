<?php

namespace App\Http\Actions;

use App\Models\Post;

class PostAction
{
    public function loadPosts()
    {
        return Post::paginate(5);
    }

    /**
     * @param int $userId
     * @param string $title
     * @param string $content
     * @return void
     */
    public function storePost(int $userId, string $title, string $content): void
    {
        Post::create([
            'user_id' => $userId,
            'title'   => $title,
            'content' => $content,
        ]);
    }

    /**
     * @param \App\Models\Post $post
     * @param string $title
     * @param string $content
     * @return void
     */
    public function updatePost(Post $post, string $title, string $content): void
    {
        $post->fill([
            'title'   => $title,
            'content' => $content,
        ])->save();
    }

    /**
     * @param \App\Models\Post $post
     * @return void
     */
    public function deletePost(Post $post): void
    {
        $post->delete();
    }
}
