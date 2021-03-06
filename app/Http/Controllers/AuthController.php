<?php

namespace App\Http\Controllers;

use Alert;
use App\Http\Requests\auth\LoginRequest;
use App\Http\Requests\auth\RegisterRequest;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    /**
     * Login existing user
     */
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password']
        ];
        if (Auth::attempt($credentials, $request->remember)) {
            return redirect()->intended('explore')
                ->withSuccess("Welcome Back " . Auth::user()->name);
        }
        Alert::error('Login Failed', 'Please check your credentials');
        return redirect()->route('auth.login')->withErrors(
            ['auth_error' => 'Login details are not valid.']
        );
    }

    public function registration()
    {
        return view('auth.register');
    }


    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $check = $this->create($data);
        $credentials = ['email' => $check['email'], 'password' => $data['password']];
        if (Auth::attempt($credentials)) {
            return redirect()->route('explore.show')
                ->withSuccess("Welcome" . Auth::user()->name);
        }
        return redirect()->route('auth.register')->withErrors([
            'register_error' => 'Some thing went wrong, please try again.'
        ]);
    }


    public function create(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }


    public function explore()
    {
        if (Auth::check()) {
            return view('explore');
        }

        return redirect()->route('auth.login')->withErrors(['auth_error' => 'You are not allowed to access']);
    }


    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
