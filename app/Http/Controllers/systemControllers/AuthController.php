<?php

namespace App\Http\Controllers\systemControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
{
    try {
        $credentials = $request->validate([
            "email" => "required|email",
            "password" => "required|string"
        ]);

        if (Auth::guard()->attempt($credentials)) {
            $user = Auth::guard()->user();
            if ($user->status === 'cancelado') {
                Auth::guard()->logout();
                return back()->with('error', 'Sua conta foi cancelada. Contate o suporte.');
            }
            return redirect('/');
        }
        return back()->with('error', 'Credenciais incorretas.');
    } catch (\Throwable $th) {
        return back()->with('error', 'Ops! Algo deu errado: ' . $th->getMessage());
    }
}


    public function logout(Request $request)
    {
        try {

            Auth::logout();
            return redirect()->back();
        } catch (\Throwable $th) {
            return back()->with('error','Ops! Algo deu errado '.$th);
           }
    }
}
