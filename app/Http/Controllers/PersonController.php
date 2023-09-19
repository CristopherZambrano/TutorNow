<?php

namespace App\Http\Controllers;

use App\Models\lesson;
use App\Models\person;
use App\Models\studentList;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PersonController extends Controller
{
    public function checkUserExists(Request $request){
        $user = $request->input('email');
        $password = $request->input('password');
        $person = person::where('user', $user)->first();
        if($person){
            if($person->password === $password){
                $request->session()->put('persona', $person);
                return Redirect::route('Home');
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
        $person->idTipoUser = 1;

        $exist = person::where('user', $person->user)->first();
        if($exist){
            return redirect()->back()->withErrors(['error' => 'Este correo electronico pertenece a una cuenta ya creada']);
        }
        else{
            $person->save();
            return redirect()->route('Genesis')->with('success', 'Usuario creado exitosamente');        
        }
    }
    
    public function perfilUser (){
        $person = session()->get('persona');
        $details = [];
        if($person->idTipoUser === 1){
            $details['detalle'] = 'Estudiante';
            $listaMaterias= studentList::where('id_person', $person->id)->count();
            $details['numeroClases'] = $listaMaterias;
        }
        else{
            $details['detalle'] = 'Docente';
            $listaMaterias=lesson::where('id_persons',$person->id)->count();
            $details['numeroClases'] = $listaMaterias;
        }
        return view('perfil', [
                    'persona' => $person,
                    'detalle' => $details    
                ]);
    }

    public function changePassword(Request $request){
        $person = session()->get('persona');
        $password = $request->input('password');
        if($request->input('newPasswordV')===$request->input('newPassword')){
            if($person->password ===$password){
                $person->password = $request->input('newPassword');
                $person->save();
                return redirect()->route('perfilUser')->with('success', 'Contraseña cambiada');
            }
            else{
                return redirect()->back()->withErrors(['error' => 'Contraseña incorrecta']);
            }
        }
        else{
            return redirect()->back()->withErrors(['error' => 'Las nuevas contraseñas no coinciden']);
        }
    }
}
