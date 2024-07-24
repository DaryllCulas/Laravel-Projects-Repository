<x-layout>
    <h1 class="title">Register a new account </h1>

        <div class="mx-auto max-w-screen-sm bg-slate-300 shadow-lg p-5">
            <form action="{{ route('register') }}" method="post">
                @csrf
                {{-- Username --}}
                <div class="mb-4">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="input">
                </div>

                    {{-- Password --}}
                <div class="mb-4">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="input">
                </div>

                    {{-- Confirm Password --}}
                <div class="mb-4">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="input">
                </div>
                <button class="primary-btn bg-blue-950">Register</button>
            </form>


        </div>
</x-layout>

