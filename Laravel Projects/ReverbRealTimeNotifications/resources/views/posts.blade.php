@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-list"></i> {{ __('Posts List') }}</div>
                <div class="card-body">
                    @session('success')
                    <div class="alert alert-success" role="alert">
                        {{ value }}
                    </div>
                    @endsession
                </div>
                <div id="notification">
                    @if(!auth()->user()->is_admin)
                    <p><strong>Create New Post</strong></p>
                    <form method="post" action="{{ route('posts.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>Title: </label>
                            <input type="text" name="title" class="form-control" />
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Body</label>
                            <textarea name="body" class="form-control"></textarea>
                            @error('body')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-2 form-group">
                            <button type="submit" class="btn btn-success btn-block"><i
                                    class="fa fa-save"></i>Submit</button>
                        </div>
                    </form>
                    @endif

                    <p class="mt-4"><strong>Post List:</strong></p>
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th width="70px">ID</th>
                                <th>Title</th>
                                <th>Body</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->body }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">There are no posts.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@if(auth()->user()->is_admin)
<script type="module">
    window.Echo.channel('posts')
        .listen('create', (data) => {
            console.log('Order status updated', data);
            var dl = document.getElementById('notification');
            dl.insertAdjacentHTML('beforeend', '<div class="alert alert-success alert-dismissible fade-show"><span><i class=""fa fa-circle-check></i> '+data.message+'</span></div>');
        });
</script>
@endif
@endsection