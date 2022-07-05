<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;

class ProfileController extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        return $request->user();
    }
}
