
@unless (current_user()->is($user))

    <!--or swap the action method with this instead of the named route
      action="/profiles/{{$user->username}}/follow"-->
<form method="POST"
      action="{{route('follow', $user->username)}}"
    >

    @csrf
    <button
        type="submit"
        class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-sm"
    >
        {{ current_user()->following($user) ? 'Unfollow Me' : 'Follow Me' }} </button>
</form>
    @endunless
