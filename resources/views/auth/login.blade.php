@extends('layouts.app')
@section('page-title')
    Login
@endsection
@section('content')
    <div class="flex flex-col w-full h-screen lg:flex-row-reverse">
        {{-- Image section --}}
        <div class="flex flex-col items-center flex-1 gap-3 p-10 lg:p-20 bg-indigo-50 lg:h-full lg:w-full">
            <p class="text-base text-app-grey lg:text-xl">Nice to see you again</p>
            <h2 class="text-3xl font-bold lg:text-4xl text-primary">Welcome back</h2>
            <img class="w-full h-full" src="{{ asset('assets/svg/auth_logo.svg') }}" alt="auth_image">
        </div>
        {{-- Form Section --}}
        <div class="container flex flex-col flex-1 gap-3 mt-3">
            <div class="flex flex-col h-full gap-3 p-5 mt-3 text-sm text-dark-blue lg:mt-16">
                {{-- Login text --}}
                <div class="space-y-2 lg:px-15">
                    <h3 class="text-3xl font-bold text-dark-blue">Log in.</h3>
                    <p class="text-sm text-app-grey">Log in with your data that you entered during your registration</p>
                </div>
                {{-- Login form --}}
                <form action="{{ route('auth.login') }}" autocomplete="off" method="POST"
                    class="flex flex-col w-full gap-3 mt-3 text-sm lg:py-5 lg:px-15 text-dark-blue">
                    @csrf
                    {{-- Email --}}
                    <label for="email" class="block">Enter your email address</label>
                    <input type="text" id="email" placeholder="name@example.com" name="email" value="{{ old('email') }}">
                    {{-- Password --}}
                    <label for="password" class="block mt-3">Enter your password</label>
                    <input type="password" id="password" placeholder="Enter at least 8 characters" name="password">
                    @if ($errors->has('password'))
                        <p class="text-red-500 ">{{ $errors->first('password') }}</p>
                    @endif
                    @if ($errors->has('auth_error'))
                        <p class="text-red-500 ">{{ $errors->first('auth_error') }}</p>
                    @endif
                    <button type="submit" class="inline-block px-6 py-2 text-white rounded-md bg-primary ">Login</button>
                    {{-- ! Remember --}}
                    <div class="flex px-6 mt-3 lg:items-center gap-x-2">
                        <input type="checkbox" name="remember" id="remember"
                            class="border-gray-300 rounded text-primary focus:ring-primary">
                        <label for="remember" class="text-xs lg:text-sm text-app-grey">
                            Use password for logging into my account
                        </label>
                    </div>
                    {{-- Forget password --}}
                    <div class="mx-auto mt-3 text-primary">
                        <a href="#">Forget password?</a>
                    </div>
                </form>
                <hr class="w-5/6 mx-auto shadow-sm bg-app-grey">
                {{-- Sign up --}}
                <p class="my-2 text-xs text-center text-app-grey">Don't have account? <a
                        href="{{ route('auth.register') }}" class="text-primary">Register</a></p>
            </div>
        </div>
    </div>
@endsection
