<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;

class PostController extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        return $request->user()->posts()
            ->with(['images'])
            ->get();
    }

    /**
     * @throws \Exception
     */
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string|max:10240',
            'status' => 'required|integer',
        ]);

        $post = $request->user()->posts()->create([
            'title' => $request->title,
            'text' => $request->text,
            'status' => $request->status,
        ]);

        if (!$post->save()) {
            throw new \Exception('Error create post.');
        }

        return $post;
    }

    public function show(Request $request, int $id)
    {
        return $request->user()->posts()
            ->with(['images'])
            ->where(['id' => $id])
            ->firstOrFail();
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string|max:2048',
            'status' => 'required|integer',
        ]);

        $post = $request->user()->posts()
            ->where(['id' => $id])
            ->firstOrFail();

        $post->title = $request->title;
        $post->text = $request->text;
        $post->status = $request->status;

        if (!$post->save()) {
            throw new \Exception('Error update post.');
        }

        return $post;
    }

    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }
}
