<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    public function index() {
      return view('auth.login');
    }

    public function login(Request $request) {
      $credentials = [
        'email' => $request->email,
        'password' => $request->password,
        'inactive' => 0
      ];


      if (Auth::attempt($credentials)) {
        return view('welcome');
      }


      print_r('não logou');
      exit();

      return redirect()->route('auth.login')->with('msg_error', 'Autenticação falhou.'); 
    }

    public function logout() {
      Auth::logout();

      return redirect()->route('auth.login');
    }
}
