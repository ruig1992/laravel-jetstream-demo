<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Read the post
     *
     * @param Request $request
     * @param Post $post
     * @return Post
     * @throws AuthorizationException
     */
    public function show(Request $request, Post $post)
    {
        /** @var User $user */
        $user = $request->user();
        if (!$user->tokenCan('read-post')) {
            throw new AuthorizationException();
        }
        return $post;
    }

    /**
     * Delete the post
     *
     * @param Request $request
     * @param Post $post
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Request $request, Post $post)
    {
        /** @var User $user */
        $user = $request->user();
        if (!$user->tokenCan('delete-post')) {
            throw new AuthorizationException();
        }
        return $post->delete();
    }
}
