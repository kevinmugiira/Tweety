<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function store(User $user)
    {
        //have an authenticated user follow a given user
        auth()->user()->toggleFollow($user);
        return back();
    }
}
