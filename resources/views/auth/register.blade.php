@extends('layouts.main')

@section('title', 'Register')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold text-center text-red-600 mb-6">🎓 Create Account</h1>

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label class="block text-sm font-bold mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="w-full border border-gray-300 rounded px-3 py-2 mb-4 text-sm">

            <label class="block text-sm font-bold mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="w-full border border-gray-300 rounded px-3 py-2 mb-4 text-sm">

            <label class="block text-sm font-bold mb-1">Password</label>
            <input type="password" name="password"
                class="w-full border border-gray-300 rounded px-3 py-2 mb-4 text-sm">

            <label class="block text-sm font-bold mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation"
                class="w-full border border-gray-300 rounded px-3 py-2 mb-4 text-sm">

            <button type="submit"
                class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700 font-bold">
                Register
            </button>
        </form>

        <p class="text-center text-sm mt-4">
            Already have an account?
            <a href="{{ route('login') }}" class="text-red-600 underline">Log in</a>
        </p>
    </div>
</div>
@endsection