@extends('layouts.app')
@section('page-title')
    Login
@endsection
@section('content')
    <div class="flex flex-col lg:flex-row-reverse h-screen w-full">
        {{-- Image section --}}
        <div class="flex flex-col items-center gap-3 lg:p-20 p-10 bg-indigo-50 flex-1 lg:h-full lg:w-full">
            <p class="text-app-grey text-md lg:text-xl">Nice to see you again</p>
            <h2 class="text-3xl lg:text-4xl font-bold text-primary">Welcome back</h2>
            <img class="h-full w-full" src="{{ asset('assets/svg/auth_logo.svg') }}" alt="auth_image">
        </div>
        {{-- Form Section --}}
        <div class="container flex flex-col gap-3 mt-3 flex-1">
            {{-- Branding --}}
            <div class="hidden lg:block mx-20 my-7">
                <a href="/"><img src="{{ asset('assets/svg/branding.svg') }}" alt="logo" /></a>
            </div>
            <div class="flex flex-col p-5 mt-3 text-sm text-dark-blue gap-3 lg:mt-16 h-full">
                {{-- Login text --}}
                <div class="space-y-2 lg:px-20">
                    <h3 class="font-bold text-3xl text-dark-blue">Log in.</h3>
                    <p class="text-app-grey text-sm">Log in with your data that you entered during your registration</p>
                </div>
                {{-- Login form --}}
                <form action="{{ route('auth.login') }}" autocomplete="off" method="POST"
                    class="flex flex-col lg:px-20 py-5 mt-3 text-sm text-dark-blue gap-3">
                    @csrf
                    {{-- Email --}}
                    <label for="email" class="block">Enter your email address</label>
                    <input type="text" id="email" placeholder="name@example.com" name="email" value="{{ old('email') }}">
                    {{-- Password --}}
                    <label for="password" class="block mt-3">Enter your password</label>
                    <input type="password" id="password" placeholder="Enter at least 8 characters" name="password">
                    @if ($errors->has('password'))
                        <p class=" text-red-500">{{ $errors->first('password') }}</p>
                    @endif
                    @if ($errors->has('auth_error'))
                        <p class=" text-red-500">{{ $errors->first('auth_error') }}</p>
                    @endif
                    <button type="submit" class="rounded-md bg-primary px-6 py-2 text-white inline-block ">Login</button>
                    {{-- ! Remember --}}
                    <div class="px-6 mt-3 flex lg:items-center gap-x-2">
                        <input type="checkbox" name="remember" id="remember"
                            class=" text-primary rounded focus:ring-primary border-gray-300">
                        <label for="remember" class="text-xs lg:text-sm text-app-grey">
                            Use password for logging into my account
                        </label>
                    </div>
                    {{-- Forget password --}}
                    <div class="mt-3 mx-auto text-primary">
                        <a href="#">Forget password?</a>
                    </div>
                </form>
                <hr class=" w-5/6 mx-auto bg-app-grey shadow-sm">
                {{-- Sign up --}}
                <p class="text-center my-2 text-app-grey text-xs">Don't have account? <a
                        href="{{ route('auth.register') }}" class="text-primary">Register</a></p>
            </div>
        </div>
    </div>
@endsection
