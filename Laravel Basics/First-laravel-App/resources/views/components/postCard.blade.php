@props(['postItem', 'full' => false])

<div class="card">

    {{-- Cover Photo --}}
    <div>
        @if ($postItem->image)
            <img src="{{ asset('storage/' . $postItem->image) }}">
        @else
            <img src="{{ asset('storage/posts_images/iWyehxmM0QBO59KBn1QO0DG1MCNN2aqBof1BVp5b.png') }}">
        @endif



    </div>

    {{-- Title --}}
    <h2 class="font-bold text-xl"> {{ $postItem->title }}</h2>

    {{-- Author and Date: USE CARBON() --}}
    <div class="text-xs font-light mb-4">
        <span>Posted {{ $postItem->created_at->diffForHumans() }} by</span>
        <a href="{{ route('posts.user', $postItem->user) }}" class="text-blue-500 font-medium">{{ $postItem->user->username }}</a>
    </div>

    {{-- Body --}}
    @if ($full)
        <div class="text-sm">
            <span>{{ $postItem->body }}</span>

        </div>
    @else
    <div class="text-sm">
        <span>{{ Str::words($postItem->body, 10) }}</span>
        <a href="{{ route('posts.show', $postItem) }}" class="text-blue-500 ml-2">Read more &rarr; </a>
    </div>
    @endif

    <div class="flex items-center justify-end gap-4 mt-6">
        {{ $slot }}
    </div>


</div>
