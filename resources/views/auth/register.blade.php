@extends('layouts.app')
@section('page-title')
    Register
@endsection
@section('content')
    <div class="flex flex-col lg:flex-row-reverse h-screen w-full">
        {{-- Image section --}}
        <div class="flex flex-col items-center gap-3 lg:p-20 p-10 bg-indigo-50 flex-1 lg:h-full lg:w-full">
            <p class="text-app-grey text-base">The world of cars is waiting</p>
            <h2 class="text-3xl lg:text-4xl font-bold text-primary">Create an account</h2>
            <img class="h-full w-full" src="{{ asset('assets/svg/register.svg') }}" alt="auth_image">
        </div>
        {{-- Form Section --}}
        <div class="container flex flex-col gap-3 mt-3 flex-1">
            {{-- Branding --}}
            <div class="hidden lg:block mx-20 my-7">
                <a href="/"><img src="{{ asset('assets/svg/branding.svg') }}" alt="logo" /></a>
            </div>
            <div class="flex flex-col p-5 mt-3 text-sm text-dark-blue gap-3 lg:mt-16 h-full">
                {{-- Register form --}}
                <form action="{{ route('auth.register') }}" autocomplete="off" method="POST"
                    class="flex flex-col lg:px-20 py-5 mt-3 text-sm text-dark-blue gap-3">
                    @csrf
                    {{-- Name --}}
                    <label for="name" class="block">Enter your name</label>
                    <input type="text" id="name" placeholder="John Doe" name="name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <p class=" text-red-500">{{ $errors->first('name') }}</p>
                    @endif
                    {{-- Email --}}
                    <label for="email" class="block mt-3">Enter your email address</label>
                    <input type="text" id="email" placeholder="name@example.com" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <p class=" text-red-500">{{ $errors->first('email') }}</p>
                    @endif
                    {{-- Password --}}
                    <label for="password" class="block mt-3">Enter your password</label>
                    <input type="password" id="password" placeholder="Enter at least 8 characters" name="password">
                    {{-- Confirm Password --}}
                    <label for="password-confirmation" class="block mt-3">Confirm password</label>
                    <input type="password" id="password-confirmation" placeholder="Confirm your password"
                        name="password_confirmation">
                    @if ($errors->has('password'))
                        <p class=" text-red-500">{{ $errors->first('password') }}</p>
                    @endif
                    @if ($errors->has('register_error'))
                        <p class=" text-red-500">{{ $errors->first('register_error') }}</p>
                    @endif
                    <button type="submit" class="rounded-md bg-primary px-6 py-2 text-white inline-block ">Register</button>
                </form>
                <hr class=" w-5/6 mx-auto bg-app-grey shadow-sm">
                {{-- Login --}}
                <p class="text-center my-2 text-app-grey text-xs">Already have an account? <a
                        href="{{ route('auth.login') }}" class="text-primary">Login</a></p>

            </div>
        </div>
    </div>
@endsection
