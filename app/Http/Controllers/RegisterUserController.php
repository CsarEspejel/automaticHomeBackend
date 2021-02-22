<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterUserController extends Controller
{
    /**
     * Registration of a new user
     */
    public function register(Request $request){
        
        $this->validate($request, [
            'rol' => 'required',
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $user = User::create([
            'roles_fk' => $request->rol,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'email_master' => $request->email_master,
        ]);

        return response()->json(['success' => 'Usuario creado con éxito'], 200);
    }
}
