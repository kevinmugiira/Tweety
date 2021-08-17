<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
        return view('profiles.show', compact('user'));
    }

    public function edit(User $user)
    {
        //ensuring that the only person able to edit the profile is the specific user
        #abort_if($user->isNot(current_user()), 404);

        //authorization, works just like the above line but is first declared within a policy, 'UserPolicy'
        //this authorization can also be defined within the routes class
        #$this->authorize('edit', $user);

        return view('profiles.edit', compact($user));
    }
}
