<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Statik admin bilgileri
    private $adminCredentials = [
        'username' => 'admin',
        'password' => 'meringa123'
    ];

    public function showLogin()
    {
        // Zaten giriş yapmışsa admin panele yönlendir
        if (Session::has('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Kullanıcı adı gereklidir.',
            'password.required' => 'Şifre gereklidir.'
        ]);

        if ($request->username === $this->adminCredentials['username'] &&
            $request->password === $this->adminCredentials['password']) {

            // Session'a giriş bilgisini kaydet
            Session::put('admin_logged_in', true);
            Session::put('admin_username', $request->username);

            return redirect()->route('admin.dashboard')->with('success', 'Başarıyla giriş yaptınız!');
        }

        return back()->withErrors([
            'login' => 'Kullanıcı adı veya şifre hatalı.'
        ])->withInput($request->only('username'));
    }

    public function logout()
    {
        Session::forget('admin_logged_in');
        Session::forget('admin_username');

        return redirect()->route('admin.login')->with('success', 'Başarıyla çıkış yaptınız!');
    }
}
