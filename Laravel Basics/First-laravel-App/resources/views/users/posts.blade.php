<x-layout>

    <h1 class="title text-left">{{ $user->username }}'s Posts</h1>
    <h2 class="from-neutral-500 mb-4"> &#9830; Number of Posts: {{ $posts->total() }} </h2>


    {{-- User's post --}}

    <div class="grid grid-cols-2 gap-6">

        @foreach ($posts as $postItem)
            <x-postCard :postItem="$postItem" />
        @endforeach
    </div>

    <div>
        {{ $posts->links() }}
    </div>
</x-layout>
