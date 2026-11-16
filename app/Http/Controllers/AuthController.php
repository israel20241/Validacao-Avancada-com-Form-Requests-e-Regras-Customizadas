<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }

    public function loginSubmit(Request $request){
        
        $request->validate(
            [
                'text_username' => 'required|min:3',
                'text_password' => 'required|min:6',
            ],
            [
                'text_username.required' => 'O campo e-mail é obrigatório.',
                'text_username.email' => 'O campo de e-mail deve conter um endereço válido.',
                'text_username.min' => 'O campo e-mail deve ter no mínimo 3 caracteres',

                'text_password.required' => 'O campo password é obrigatório.',
                'text_password.min' => 'O campo password deve ter no mínimo 6 caracteres',

            ]
        );
    
        $name = $request->input('text_username');
        $password = $request->input('text_password');

        $user = User::where('name',$name)
                    ->whereNull('deleted_at')
                    ->first();
        
        if(!$user){
            return redirect()->back()
                    ->withInput()
                    ->with('login_error','name ou password incorretos!');
        } else {
            if(!password_verify($password,$user->password)){
                return redirect()->back()
                        ->withInput()
                        ->with('login_error','Username ou password incorretos!');
            }
        }
        
        $user->last_login = date('Y-m-d H:i:s');
        $user->save(); 
        session([
            'user' => [
                'id' => $user->id,
                'username' => $user->name,
            ]
        ]);

        return redirect('/');

    }

    public function create(){
        return 'Criando usuario';
    }

    public function logout(){
        
        session()->forget('user');
      
       return redirect()->route('login');
    }
}
