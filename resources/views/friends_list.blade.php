
<div class="bg-blue-100 border border-blue-300 rounded py-4 px-6">

     <h3 class="font-bold text-xl mb-4">Following</h3>

        <ul>

    <!-- below statement from foreach to forelse,
    to allow display of list tag statement 'no friends',
    when a user has no friends -->

    @forelse(auth()->user()->follows as $user)
     <li class="{{ $loop->last ? '' : 'mb-4' }}">
        <div>
            <a href="{{route('profile', $user)}}" class="flex items-center text-sm">
            <img
                src="{{$user->avatar}}"
                alt=""
                class="rounded-full mr-2"
                width="40"
                height="40"
            >


            {{$user->name}}

            </a>

        </div>
     </li>
    @empty
        <li>No friends yet!</li>
    @endforelse
</ul>
</div>
