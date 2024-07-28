<x-layout>

    <a href="{{ route('dashboard') }}" class="mb-2 block text-xs text-blue-500">&larr; Go back to Dashboard</a>

    <div class="card">
        <h2 class="mb-4 font-bold">Update a new post</h2>

        {{-- Update form --}}
        <form action="{{ route('posts.update', $post) }}" method="post" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            {{-- Post Title --}}
            <div class="mb-4">
                <label for="title">Post Title</label>
                <input type="text" name="title" value="{{ $post->title }}"
                    class="input @error('title') ring-red-500 @enderror">
                @error('title')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Post Body --}}
            <div class="mb-4">
                <label for="title">Post Content</label>

                <textarea name="body" rows="5"
                    class="input @error('body') ring-red-500 @enderror">{{ $post->body }}</textarea>

                @error('body')
                <p class="error">{{ $message }}</p>
                @enderror

            </div>
            {{-- Current image if exists --}}
            @if ($post->image)
            <div class="mb-4 h-52 w-full overflow-hidden rounded-md object-cover">
                <label>Current cover photo</label>
                <img src="{{ asset('storage/' . $post->image) }}">

            </div>
            @else
            <div class="mb-4 h-52 w-full overflow-hidden rounded-md object-cover">
                <label>Current cover photo</label>
                <img src="{{ asset('storage/posts_images/iWyehxmM0QBO59KBn1QO0DG1MCNN2aqBof1BVp5b.png') }}">
            </div>
            @endif

            {{-- Post Image --}}
            <div class="mb-4">
                <label for="image">Cover Photo</label>
                <input type="file" name="image" id="image">

                @error('image')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button class="primary-btn bg-blue-950">Update</button>
        </form>
    </div>
</x-layout>