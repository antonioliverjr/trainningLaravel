<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\Hash;
//use App\Models\User;

class LoginController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user()) {
            return redirect('Books');
        } else {
            return view('auth.welcome');
        }
    }

    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            return redirect('Books');
        } else {
            return back()->withErrors([
                'login' => 'E-mail e senha não correspondem ao cadastrado!',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
