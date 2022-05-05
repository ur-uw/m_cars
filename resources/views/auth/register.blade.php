@extends('layouts.app')
@section('page-title')
    Register
@endsection
@section('content')
    <div class="flex flex-col w-full h-screen lg:flex-row-reverse">
        {{-- Image section --}}
        <div class="flex flex-col items-center flex-1 gap-3 p-10 lg:p-20 bg-indigo-50 lg:h-full lg:w-full">
            <p class="text-base text-app-grey">The world of cars is waiting</p>
            <h2 class="text-3xl font-bold lg:text-4xl text-primary">Create an account</h2>
            <img class="w-full h-full" src="{{ asset('assets/svg/register.svg') }}" alt="auth_image">
        </div>

        {{-- Form Section --}}
        <div class="container flex flex-col flex-1 gap-3 mt-3">
            <div class="flex flex-col h-full gap-3 p-5 mt-3 text-sm text-dark-blue lg:mt-16">
                <div class="space-y-2 lg:px-15">
                    <h3 class="text-3xl font-bold text-dark-blue">Register.</h3>
                </div>
                {{-- Register form --}}
                <form action="{{ route('auth.register') }}" autocomplete="off" method="POST"
                    class="flex flex-col gap-3 py-5 mt-3 text-sm lg:px-15 text-dark-blue">
                    @csrf
                    {{-- Name --}}
                    <label for="name" class="block">Enter your name</label>
                    <input type="text" id="name" placeholder="John Doe" name="name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <p class="text-red-500 ">{{ $errors->first('name') }}</p>
                    @endif
                    {{-- Email --}}
                    <label for="email" class="block mt-3">Enter your email address</label>
                    <input type="text" id="email" placeholder="name@example.com" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <p class="text-red-500 ">{{ $errors->first('email') }}</p>
                    @endif
                    {{-- Password --}}
                    <label for="password" class="block mt-3">Enter your password</label>
                    <input type="password" id="password" placeholder="Enter at least 8 characters" name="password">
                    {{-- Confirm Password --}}
                    <label for="password-confirmation" class="block mt-3">Confirm password</label>
                    <input type="password" id="password-confirmation" placeholder="Confirm your password"
                        name="password_confirmation">
                    @if ($errors->has('password'))
                        <p class="text-red-500 ">{{ $errors->first('password') }}</p>
                    @endif
                    @if ($errors->has('register_error'))
                        <p class="text-red-500 ">{{ $errors->first('register_error') }}</p>
                    @endif
                    <button type="submit" class="inline-block px-6 py-2 text-white rounded-md bg-primary ">Register</button>
                </form>
                <hr class="w-5/6 mx-auto shadow-sm bg-app-grey">
                {{-- Login --}}
                <p class="my-2 text-xs text-center text-app-grey">Already have an account? <a
                        href="{{ route('auth.login') }}" class="text-primary">Login</a></p>

            </div>
        </div>
    </div>
@endsection
