<x-layout>
    <h1 class="title">Welcome Back</h1>

    {{-- Session Message --}}
    @if (session('status'))
    <x-flashMsg msg="{{ session('status') }}" />
    @endif

    <div class="mx-auto max-w-screen-sm bg-slate-300 shadow-lg p-5">
        <form action="{{ route('login') }}" method="post">
            @csrf
            {{-- Email --}}
            <div class="mb-4">
                <label for="email">Email</label>
                <input type="text" name="email" value="{{ old('email') }}" class="input
                    @error('email') ring-red-500 @enderror">
                @error('email')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" class="input
                    @error('password') ring-red-500 @enderror">
                @error('password')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember checkbox--}}
            <div class="mb-4 flex justify-between items-center">
                <div>
                    <label for="remember">Remember me</label>
                    <input type="checkbox" name="remember" id="remember">
                </div>

                <a class="text-blue-500" href="{{ route('password.request') }}">Forgot your password?</a>
            </div>
            @error('failed')
            <p class="error">{{ $message }}</p>
            @enderror

            <button class="primary-btn bg-blue-950">Login</button>
        </form>


    </div>
</x-layout>
