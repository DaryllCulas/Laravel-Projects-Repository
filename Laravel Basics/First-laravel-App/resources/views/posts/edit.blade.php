<x-layout>

    <a href="{{ route('dashboard') }}" class="block mb-2 text-xs text-blue-500">&larr; Go back to Dashboard</a>

    <div class="card">
        <h2 class="font-bold mb-4">Update a new post</h2>
    <form action="{{ route('posts.update', $post) }}" method="post">

        @csrf
        @method('PUT')
        {{-- Post Title --}}
        <div class="mb-4">
            <label for="title">Post Title</label>
            <input type="text" name="title" value="{{ $post->title }}" class="input
            @error('title') ring-red-500 @enderror">
            @error('title')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Post Body --}}
        <div class="mb-4">
            <label for="title">Post Content</label>

            <textarea name="body" rows="5" class="input @error('body') ring-red-500 @enderror">{{ $post->body }}</textarea>

            @error('body')
            <p class="error">{{ $message }}</p>
            @enderror

        </div>
        {{-- Submit Button --}}
        <button class="primary-btn bg-blue-950">Update</button>
    </form>
</div>
</x-layout>


