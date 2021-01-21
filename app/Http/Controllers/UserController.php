<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\UserRequest;
use App\User;

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
     * @return \Illuminate\Http\Response
     */
    public function choose()
    {
        return view('users.choose');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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

            connectify('error', 'Erro no servidor', 'Erro ao cadastrar cliente.');

            return redirect()->back()->withInput();
        }

        notify()->success('Usuário cadastrado com sucesso!');

        return redirect()->route('auth.login');
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
        //
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
        //
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

      notify()->success('Usuário inativado com sucesso!');

      return back();
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

      notify()->success('Usuário apagado com sucesso!');

      return back();
    }
}
