@props(['postItem', 'full' => false])

<div class="card">

    {{-- Cover Photo --}}
    <div class="mb-4 h-52 w-full overflow-hidden rounded-md object-cover">
        @if ($postItem->image)
        <img src="{{ asset('storage/' . $postItem->image) }}">
        @else
        <img src="{{ asset('storage/posts_images/iWyehxmM0QBO59KBn1QO0DG1MCNN2aqBof1BVp5b.png') }}">
        @endif
    </div>

    {{-- Title --}}
    <h2 class="text-xl font-bold"> {{ $postItem->title }}</h2>

    {{-- Author and Date: USE CARBON() --}}
    <div class="mb-4 text-xs font-light">
        <span>Posted {{ $postItem->created_at->diffForHumans() }} by</span>
        <a href="{{ route('posts.user', $postItem->user) }}" class="font-medium text-blue-500">{{
            $postItem->user->username }}</a>
    </div>

    {{-- Body --}}
    @if ($full)
    <div class="text-sm">
        <span>{{ $postItem->body }}</span>

    </div>
    @else
    {{-- Body Short --}}
    <div class="text-sm">
        <span>{{ Str::words($postItem->body, 10) }}</span>
        <a href="{{ route('posts.show', $postItem) }}" class="ml-2 text-blue-500">Read more &rarr; </a>
    </div>
    @endif

    <div class="mt-6 flex items-center justify-end gap-4">
        {{ $slot }}
    </div>


</div>