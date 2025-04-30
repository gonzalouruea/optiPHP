@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="px-8 py-6 mt-4 text-left bg-white shadow-lg">
            <h3 class="text-2xl font-bold text-center">Login</h3>
            <form method="POST" action="/login">
                @csrf
                <div class="mt-4">
                    <div>
                        <label class="block" for="email">Email<label>
                                <input type="text" placeholder="Email" name="email"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                    </div>
                    <div class="mt-4">
                        <label class="block" for="password">Password<label>
                                <input type="password" placeholder="Password" name="password"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                    </div>
                    <div class="flex items-baseline justify-between mt-4">
                        <button type="submit"
                            class="px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900">Login</button>
                        <a href="/register" class="text-sm text-blue-600 hover:underline">Register</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection