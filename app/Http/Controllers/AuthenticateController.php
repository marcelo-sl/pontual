<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

use App\User;

class AuthenticateController extends Controller
{
  public function index()
  {
    return view('auth.login');
  }

  public function login(Request $request)
  {
    $credentials = [
      'email' => $request->email,
      'password' => $request->password,
      'inactive' => 0
    ];


    if (Auth::attempt($credentials)) {
      return redirect()->route('user.index');
    } else {
      $request->flashOnly(['email']);
      connectify('error', 'Falha na autenticação!', 'Usuário ou senha incorreto.');
      return redirect()->route('auth.index');
    }
  }

  public function logout()
  {
    Auth::logout();

    return redirect()->route('auth.login');
  }

  public function resetPassword()
  {
    $credentials = request()->validate(['email' => 'required|email']);

    $user = User::firstWhere('email', $credentials['email']);
    if (isset($user)) {
      print('E agora José?');
      exit();
      Password::sendResetLink($credentials);
      connectify('success', 'Código enviado', 'Check seu e-mail para ter acesso ao código.');
      return redirect()->route('auth.index');
    } else {
      request()->flashOnly(['email']);
      connectify('error', 'Falha no reset!', 'O e-mail informado não está vinculado a uma conta');
      return redirect()->route('auth.resetPass');
    }
  }
}
