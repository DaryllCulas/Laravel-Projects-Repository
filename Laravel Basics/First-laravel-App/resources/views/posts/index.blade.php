<x-layout>
    <h1 class="title">Latest Posts</h1>

    <div class="grid grid-cols-2 gap-6">

    @foreach ($posts as $postItem)

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
            <p>{{ Str::words($postItem->body, 15) }}</p>
        </div>

    </div>

    @endforeach
</div>
</x-layout>
