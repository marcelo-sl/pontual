<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

use App\Http\Requests\UserRequest;
use App\{User, Contact};

use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the view to choose the user's type.
    *
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function findByEmail($email)
    {
        $user = User::where('email', $email)->first();

        return $user;
    }
    

    /**
     * Show the view to choose the user's type.
     *
     * @return \Illuminate\Http\Response
     */
    public function choose()
    {
        $user = User::find(Auth::id());
        
        if (count($user->roles()->get()) == 1) 
        {
            if ($user->roles()->get()->first()->role_name == "Common User");
                return view('users.choose');
        }

        return redirect()->route('user.show', Auth::id());

    }

    public function completeRegistration()
    {
        return view('users.completeRegistration');
    }

    public function completeData(Request $request)
    {
        $user = User::find($request->id);

        if (isset($user))
        {
            DB::beginTransaction();

            try {

                $user->cpf = $request->cpf;
                $user->birthday = $request->birthday;

                foreach ($request->input('contacts') as $phone_number)
                {
                    Contact::create([
                        'phone_number' => $phone_number,
                        'user_id' => $user->id,
                    ]);
                }

                if(!$user->hasRole('Customer')) {
                    $user->roles()->sync([5, 6]);
                }

                $user->save();

                DB::commit();
            } catch (Exception $ex) {
                DB::rollback();

                $error =  [
                    'msg_title' => 'Falha na complementação!',
                    'msg_error' => 'Falha ao registrar valores'
                ];

                return redirect()->back()->with($error)->withInput();
            }

            $success = [
                'msg_title' => 'Sucesso ao complementar',
                'msg_success' => 'Dados do usuário complementados com sucesso!'
            ];

            return redirect()->route('user.show', $user->id)->with($success);

        }
    }

    public function getSchedules($id)
    {
        $schedules = User::findOrFail($id)->schedules()->orderBy('date_time', 'ASC')->get();
        // dd($schedules);
        return view('users.schedules', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
        } catch (\Exception $exception) {
            DB::rollback();

            $error = [
                'msg_title' => 'Erro no servidor',
                'msg_error' => 'Erro ao cadastrar cliente.'
            ];

            return redirect()->back()->with($error)->withInput();
        }

        $success = [
            'msg_title' => 'Sucesso ao cadastrar',
            'msg_success' => 'Usuário cadastrado com sucesso!'
        ];

        return redirect()->route('auth.login')->with($success);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (isset($user)) {
            DB::beginTransaction();

            try {
                $user->name = strtoupper($request->name);
                $user->birthday = $request->birthday;
                $user->gender = $request->gender;

                Contact::where('user_id', $user->id)->delete();
                foreach ($request->input('contacts') as $phone_number)
                {
                    Contact::create([
                        'phone_number' => $phone_number,
                        'user_id' => $user->id,
                    ]);
                }

                if ($request->changePassword == "on") {
                    $credentials = [
                        'email' => $request->email,
                        'password' => $request->currentlyPassword,
                        'inactive' => 0
                    ];
                    if (Auth::attempt($credentials)) {
                        $user->password = Hash::make($request->password);
                    } else {
                        $error =  [
                            'msg_title' => 'Falha na Edição!',
                            'msg_error' => 'Senha atual incorreta'
                        ];
                        return redirect()->back()->with($error)->withInput();
                    }
                }

                $user->save();

                DB::commit();
            } catch (Exception $ex) {
                DB::rollback();

                $error =  [
                    'msg_title' => 'Falha na Edição!',
                    'msg_error' => 'Falha ao registrar valores'
                ];

                return redirect()->back()->with($error)->withInput();
            }
            
            $success = [
                'msg_title' => 'Sucesso ao editar',
                'msg_success' => 'Usuário editado com sucesso!'
            ];

            return redirect()->route('user.show', $user->id)->with($success);

        } else {
            $error = [
                'msg_title' => 'Falha na Edição!',
                'msg_error' => 'Usuário não encontrado'
            ];
            return redirect()->back()->with($error);
        }

    }

    /**
     * Inactivate the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function inactivate($id)
    {
      $user = User::find($id);
      $user->inactive = 1;
      $user->save();

      $success = [
        'msg_title' => 'Sucesso ao inativar',
        'msg_success' => 'Usuário inativado com sucesso!'
      ];

      return back()->with($success);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::find($id);
      $user->inactive = 1;
      $user->delete();
    
      $success = [
        'msg_title' => 'Sucesso ao excluir',
        'msg_success' => 'Usuário apagado com sucesso!'
      ];

      return back()->with($success);
    }
}
