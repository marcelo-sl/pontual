<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests\UserRequest;
use App\Mail\ResetPasswordMail;
use App\User;
use App\Token;

use DB;
use DateTime;

class AuthenticateController extends Controller
{
  public function index()
  {
    return view('auth.login');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(UserRequest $request)
  {
    DB::beginTransaction();

    try {
      $user = new User;

      $user->name = strtoupper($request->name);
      $user->email = $request->email;
      $user->gender = $request->gender;
      $user->password = Hash::make($request->password);

      $user->save();

      $user->roles()->attach(6);

      DB::commit();
    } catch (Exception $exception) {
      DB::rollback();

      $request->flash();

      $error = [
        'msg_title' => 'Erro no servidor',
        'msg_error' => 'Erro ao cadastrar cliente.'
      ];

      return redirect()->back()->with($error);
    }

    $success = [
      'msg_title' => 'Sucesso!',
      'msg_success' => 'Usuário criado com sucesso!'
    ];

    return redirect()->route('auth.login')->with($success);
  }

  public function login(Request $request)
  {
    $credentials = [
      'email' => $request->email,
      'password' => $request->password,
      'inactive' => 0
    ];

    if (Auth::attempt($credentials)) {
      return redirect()->route('user.choose', $request->user()->id);
    } else {
      $request->flashOnly(['email']);
      
      $error = [
        'msg_title' => 'Falha na autenticação!',
        'msg_error' => 'Usuário ou senha incorreto.'
      ];
      
      return redirect()->route('auth.index')->with($error);
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
      $this->generateToken($user);
      $success = [
        'msg_title' => 'Código criado!',
        'msg_success' => 'Criamos um código de redefinição de senha e enviamos ao seu e-mail'
      ];
      return view('auth.fillToken', compact('user', 'success'));
    } else {
      request()->flashOnly(['email']);
      $error = [
        'msg_title' => 'Falha no reset!',
        'msg_error' => 'O e-mail informado não está vinculado a uma conta'
      ];
      return redirect()->route('auth.resetPass')->with($error);
    }
  }

  public function generateToken($user) {
    $tkn = Token::firstWhere('user_id', $user->id);
    
    if (isset($tkn)) {
      $tkn->token = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
      $tkn->save();
    } else {
      $newToken = new Token;
      $newToken->user_id = $user->id;
      $newToken->email = $user->email;
      $newToken->token = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
      $newToken->save();
    }
    $email = new ResetPasswordMail($user);
    Mail::send($email);
  }

  public function generateNewToken(Request $request) {
    $user = User::find($request->id);

    if (isset($user)) {
      $this->generateToken($user);
      $success = [
        'msg_title' => 'Código criado!',
        'msg_success' => 'Criamos um código de redefinição de senha e enviamos ao seu e-mail'
      ];
      return view('auth.fillToken', compact('user', 'success'));
    } else {
      $error = [
        'msg_title' => 'Falha na criação do código!',
        'msg_error' => 'O usuário informado não existe'
      ];
      return redirect()->route('auth.resetPass')->with($error);
    }
  }

  public function checkToken(Request $request) {
    $user = User::firstWhere('id', $request->id);
    $tkn = Token::firstWhere('user_id', $request->id);

    $time = new DateTime($tkn->updated_at);
    $time->add(date_interval_create_from_date_string('10 minutes'));
    if ($time >= new DateTime("now")) {
      if ($tkn->token == $request->token) {
        $tkn = $tkn->token;
        return view('auth.changePassword', compact(['user', 'tkn']));
      } else {
        $request->flashOnly(['token']);
        $error = [
          'msg_title' => 'Falha na validação!',
          'msg_error' => 'O código informado não está correto'
        ];
        return view('auth.fillToken', compact('user', 'error'));
      }
    } else {
      $request->flashOnly(['token']);
      $error = [
        'msg_title' => 'Falha na validação!',
        'msg_error' => 'O código informado expirou, gere um novo código'
      ];
      return view('auth.fillToken', compact('user', 'error'));
    }

  }

  public function changePassword(Request $request) {
    $user = User::find($request->id);
    $tkn = $request->token;

    if (isset($user)) {

      if ($user->token->token != $tkn) {
        $error = [
          'msg_title' => 'Falha na alteração de senha!',
          'msg_error' => 'Solicitação de troca de senha não condiz com esse usuário!'
        ];
        return redirect()->route('auth.index')->with($error);
      }

      $user->password = Hash::make($request->password);
      $user->save();
      $success = [
        'msg_title' => 'Senha alterada!',
        'msg_success' => 'Agora você pode acessar sua conta normalmente'
      ];
      return redirect()->route('auth.login')->with($success);
    } else {
      $error = [
        'msg_title' => 'Falha na alteração!',
        'msg_error' => 'O usuário não existe'
      ];
      return redirect()->route('auth.index')->with($error);
    }
  }
}
