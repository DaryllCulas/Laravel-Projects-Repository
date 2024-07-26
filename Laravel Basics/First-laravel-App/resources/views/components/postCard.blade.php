@props(['postItem'])

<div class="card">
    {{-- Title --}}
    <h2 class="font-bold text-xl"> {{ $postItem->title }}</h2>

    {{-- Author and Date: USE CARBON() --}}
    <div class="text-xs font-light mb-4">
        <span>Posted {{ $postItem->created_at->diffForHumans() }} by</span>
        <a href="" class="text-blue-500 font-medium">USERNAME</a>
    </div>

    {{-- Body --}}
    <div class="text-sm">
        <p>{{ Str::words($postItem->body, 10) }}</p>
    </div>
</div>
