<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        session()->flash('success', 'Регистрация успешна пройдена');
        Auth::login($user);
        return redirect()->home();


    }

    public function loginForm(){
        return view('user.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password,
        ])) {
            session()->flash('success', 'Вы вошли в систему');
            if (Auth::user()->is_admin){
                return redirect()->route('admin.index');
            }else{
                return redirect()->home();
            }
        }

        return redirect()->back()->with('error', 'Неверное имя пользователя или пароль');

    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login.route');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
