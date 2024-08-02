<h1>
    {{ $job->title }}
</h1>

<strong>Congrats! Your Job has been posted and it's now live on our website</strong>

<p>
    <a href="{{ url('/jobs/' . $job->id) }}">View your Job listing</a>
</p>