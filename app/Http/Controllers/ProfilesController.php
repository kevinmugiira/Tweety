<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfilesController extends Controller
{
    public function show(User $user)
    {

        return view('profiles.show', compact('user'));

        //checking to see if this can work too
        #return redirect()->route('profile');
    }

    public function edit(User $user)
    {
        //ensuring that the only person able to edit the profile is the specific user
        #abort_if($user->isNot(current_user()), 404);

        //authorization, works just like the above line but is first declared within a policy, 'UserPolicy'
        //this authorization can also be defined within the routes class
        #$this->authorize('edit', $user);


        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        #dd(\request('avatar'));
       $attributes = \request()->validate([
            'username' => [
                'string',
                'required',
                'max:255',
                'alpha_dash',
                Rule::unique('users')->ignore($user),
                ],
            'name' => ['string', 'required', 'max:255'],
            'avatar' => ['file'],
            'email' => [
                'string',
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user),
                ],
            'password' => [
                'string',
                'required',
                'min:8',
                'max:255',
                'confirmed',
                ],
        ]);

       // the below if statement was added after making uploading the avatar optional
        //it checks whether the avatar is present and if so, it then stores it
       if (\request('avatar')) {
           $attributes['avatar'] = \request('avatar')->store('avatars');
       }

       $user->update($attributes);

       #return redirect($user->path());
       return redirect()->route('profile', compact('user'));
    }
}
