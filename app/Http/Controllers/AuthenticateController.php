<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticateController extends Controller
{

    // LOGIN
    public function login(Request $request)
    {
        $formFields = $request->validate([
            'user' => 'required',
            'password' => 'required',
        ]);

        if ($request->filled('user')) {
            $user = User::where('username', $request->input('user'))->first();
            if ($user) {
                if ($request->filled('password')) {
                    if ($user && Hash::check($formFields['password'], $user->password)) {
                        auth()->login($user);
                        return redirect()->intended('clientes');
                    } else {
                        return back()->with('warning', 'User ou Password Incorretos');
                    }
                }
            } else {
                return back()->with('warning', 'Conta não Encontrada');
            }
        }
    }

    //LOGOUT
    public function logout()
    {
        auth()->logout();
        return redirect(route('login'));
    }


}
