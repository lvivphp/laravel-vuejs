<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use Illuminate\Http\Request;

class DefaultController extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        return Post::query()
            ->with(['user', 'images'])
            ->where(['status' => Post::STATUS_ACTIVE])
            ->orderBy('id', 'desc')
            ->get();
    }


    public function show(int $id)
    {
        return Post::query()
            ->with(['user', 'images'])
            ->where([
                'status' => Post::STATUS_ACTIVE,
                'id' => $id
            ])
            ->firstOrFail();
    }
}
