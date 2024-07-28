<x-layout>

    <h1 class="mb-4">Please verify your email through email we've sent you. </h1>

    <p>Didn't receive the email?</p>

    <form action="{{ route('verification.send') }}" method="post">
        @csrf
        <button class="primary-btn">Send Again</button>
    </form>


</x-layout>