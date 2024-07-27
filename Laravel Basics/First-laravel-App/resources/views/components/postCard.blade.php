@props(['postItem', 'full' => false])

<div class="card">
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
