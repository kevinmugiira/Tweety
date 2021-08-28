

    <div class="border border-gray-300 rounded-lg">

        <!-- changed the below statement from foreach to forelse,
        to allow displaying the 'no tweets statement'
        when there are no tweets in the timeline -->
        @forelse($tweets as $tweet)
            @include('tweet')
        @empty
            <p class="p-4"> No tweets yet!</p>
        @endforelse

        <!-- this allows pagination
         $tweets->links() }} -->
    </div>


