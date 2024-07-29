<x-layout>
    <h1 class="title">Request a password reset email</h1>

    {{-- Session Message --}}
    @if (session('status'))
    <x-flashMsg msg="{{ session('status') }}" />
    @endif


    <div class="mx-auto max-w-screen-sm bg-slate-300 shadow-lg p-5">
        <form action="{{ route('password.request') }}" method="post" x-data="formSubmit" @submit.prevent="submit">
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

            <button x-ref="btn" class="primary-btn bg-blue-950">Submit</button>
        </form>


    </div>
</x-layout>
