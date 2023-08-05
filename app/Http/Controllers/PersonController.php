<?php

namespace App\Http\Controllers;
use App\Models\person;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function checkUserExists(Request $request){
        $user = $request->input('email');
        $password = $request->input('password');
        $person = person::where('user', $user)->first();
        if($person){
            if($person->password === $password){
                return view('home');
            }
            else{
                return redirect()->back()->withErrors(['error' => 'El usuario y la contraseña no son validos']);
            }
        }
        else{
            return redirect()->back()->withErrors(['error' => 'El usuario no existe']);
        }
    }

    public function RegisterNewUser(Request $request){
        $person = new person();
        $person->name = $request->input('name');
        $person->lastName = $request->input('lastName');
        $person->user = $request->input('email');
        $person->password = $request->input('password');

        $person->save();

        return redirect()->back()->with('success', 'Usuario creado exitosamente');        
    }
}
