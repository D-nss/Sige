<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    function __construct()
    {
        //$this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
        //$this->middleware('permission:user-create', ['only' => ['create','store']]);
        //$this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        //$this->middleware('permission:user-delete', ['only' => ['destroy']]);
        $this->middleware('role:super', ['except' => ['teste']]);
    }

    public function teste()
    {
        //buscando usuário do autenticado no SiSe no sistema

        $user = User::where('email', Auth::user()->id)->first();

        //se nao encontrado
        if (!$user){
            $unidade = Unidade::where('codigo', Auth::user()->codigoUnidade)->first();

            if($unidade){
                $user = User::create([
                    'name' => implode(' ',array_unique(explode(' ', Auth::user()->name))),
                    'email' => Auth::user()->id,
                    'unidade_id' => $unidade->id,
                    'ativo' => true,
                ])->assignRole('user');
            } else {
                return 'unidade não encontrada, entre em contato com administrador do sistema!';
            }
        }

        return view('usuarios.teste', [
            'usuario' => $user,
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name', 'asc')->get();
        //$dados['usuarios'] = User::all();
        return view('usuarios.index', [
            'usuarios' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $unidades = Unidade::all();
        return view('usuarios.create', compact('roles', 'unidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'unidade' => 'required',
            'roles' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->unidade_id = $request->unidade;
        $user->ativo = true;
        $user->assignRole($request->input('roles'));
        $user->save();

        session()->flash('status', 'Usuário Criado com sucesso!');
        session()->flash('alert', 'success');

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $usuario = $user;
        return view('usuarios.show', compact('usuario', 'roles', 'permissions'));
    }

    public function assignRole(Request $request, User $user)
    {
        if ($user->hasRole($request->role)) {
            session()->flash('status', 'Papel existente.');
            session()->flash('alert', 'danger');
            return back();
        }

        $user->assignRole($request->role);

        session()->flash('status', 'Papel atribuído.');
        session()->flash('alert', 'success');
        return back();
    }

    public function removeRole(User $user, Role $role)
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            session()->flash('status', 'Papel removido.');
            session()->flash('alert', 'success');

            return back();
        }

        session()->flash('status', 'Papel não existente.');
        session()->flash('alert', 'danger');

        return back();
    }

    public function givePermission(Request $request, User $user)
    {
        if ($user->hasPermissionTo($request->permission)) {
            session()->flash('status', 'Permissão existente.');
            session()->flash('alert', 'danger');

            return back();
        }
        $user->givePermissionTo($request->permission);
        session()->flash('status', 'Permissão adicionado.');
        session()->flash('alert', 'success');

        return back();
    }

    public function revokePermission(User $user, Permission $permission)
    {
        if ($user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);
            session()->flash('status', 'Permissão revogado.');
            session()->flash('alert', 'success');

            return back();
        }

        session()->flash('status', 'Permissão não existente.');
        session()->flash('alert', 'danger');

        return back()->with('message', 'Permissão não existente.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->getRoleNames();

        $unidades = Unidade::all();
        return view('usuarios.edit', [
            'usuario' => $user,
            'unidades' => $unidades,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'roles' => 'required'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->unidade_id = $request->unidade;

        DB::table('model_has_roles')->where('model_id',$user->id)->delete();

        $user->assignRole($request->input('roles'));
        $user->save();

        session()->flash('status', 'Usuário Atualizado com sucesso');
        session()->flash('alert', 'success');

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->hasRole('super')) {
            session()->flash('status', 'é super usuário.');
            session()->flash('alert', 'danger');
            return back();
        }
        $user->delete();

        session()->flash('status', 'Usuário removido.');
        session()->flash('alert', 'success');

        return back();
    }

    /**
     * Atribui ao usuário seu atributo 'ativo' como falso
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function ativar(User $user)
    {
        $user->ativo = true;
        $user->save();
        return redirect()->route('user.index');
    }

    /**
     * Atribui ao usuário seu atributo 'ativo' como falso
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function desativar(User $user)
    {
        $user->ativo = false;
        $user->save();
        return redirect()->route('user.index');
    }
}
