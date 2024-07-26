<x-layout>
    <h1 class="title">{{ auth()->user()->username }}'s Dashboard</h1>

    {{-- Create Post Form --}}

    <div class="card mb-4">
        <h2 class="font-bold mb-4">Create a new post</h2>


            {{-- Session Message --}}

            @if (session('success'))
            <div class="mb-2">
                <x-flashMsg msg="{{ session('success') }}" />
            </div>
            @endif



        <form action="{{ route('posts.store') }}" method="post">
            @csrf

            {{-- Post Title --}}
            <div class="mb-4">
                <label for="title">Post Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="input
                @error('title') ring-red-500 @enderror">
                @error('title')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Post Body --}}
            <div class="mb-4">
                <label for="title">Post Content</label>

                <textarea name="body" rows="5" class="input @error('body') ring-red-500 @enderror">
                    {{ old('body') }}
                </textarea>

                @error('body')
                <p class="error">{{ $message }}</p>
                @enderror

            </div>
            {{-- Submit Button --}}
            <button class="primary-btn bg-blue-950">Create</button>


        </form>
    </div>

    {{-- User Posts --}}
    <h2 class="font-bold mb-4">Your Latest Post</h2>

    <div class="grid grid-cols-2 gap-6">
        @foreach ($posts as $postItem)
            <x-postCard :postItem="$postItem" />
        @endforeach
    </div>

    <div>
        {{ $posts->links() }}
    </div>
</x-layout>
