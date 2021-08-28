<x-app>


    <header class="mb-4 relative ">


        <img class="rounded-lg mb-2"
             src="/images/toons2.jpg"
             alt=""
        >

        <div class="flex justify-between items-center mb-6">
            <div style="max-width: 270px">
                <h2 class="font-bold text-2xl mb-0">{{ $user->name }}</h2>
                <p class="text-sm">Joined {{$user->created_at->diffForHumans()}}</p>
            </div>

            <div class="flex">

                <!--since authorization is declared within a policy, it's not necessary to define it here as it should-->
                <!-- if(auth()->user()->is($user)) -->
                <!--or-->
                <!-- if(current_user()->is($user) -->
                @can('edit', $user)
                   <a href="{{ $user->path('edit') }}"
                      class=" rounded-full border border-gray-300 py-2 px-4 text-black text-sm mr-2">Edit Profile</a>
                @endcan
                <!-- endif -->
                   <x-follow_button :user="$user"></x-follow_button>

            </div>

        </div>

        <p class="text-sm mt-2">
            With simplified access to telco infrastructure,
            developers use our powerful SMS, USSD, Voice,
            Airtime and Payments APIs to bring their ideas to life,
            as they build and sustain scalable businesses.
        </p>
        <!--styling for the avatar image-->
      <!--  position: absolute;

        top: 47%;

        width:150px;

        left: calc(50% - 75px); -->

        <img
            src="{{$user->avatar}}"
            alt=""
            class="rounded-full mr-2 absolute"
            style="width: 150px; left: calc(50% - 75px); top: 120px"
        >




    </header>

    <hr>


        @include('timeline', [
'tweets' => $user->tweet
])


</x-app>
