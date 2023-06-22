<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller{
   
    public function edit(Profile $profile){
        return view('subcriber.profiles.edit', compact('profile'));
    }

    
    public function update(ProfileRequest $request, Profile $profile){
        
        $user = Auth::user();

        if($request->hasFile('photo')){
            //Eliminamos la foto anterior
            File::delete(public_path('storage/'. $profile->photo));
            //Asignamos una nueva foto
            $photo = $request['photo']->store('profiles');
        }else{
            $photo = $user->profile->photo;
        }


        //Asignar nombre y correo
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        #Asignar la foto
        $user->profile->photo = $photo;
        //Asignar campos adicionales
        $user->profile->profession = $request->profession;
        $user->profile->about = $request->about;
        $user->profile->twitter = $request->twitter;
        $user->profile->linkedin = $request->linkedin;
        $user->profile->facebook = $request->facebook; 

        //Guardar campo de usuario
        $user->save();
        // Guardar campo de perfil
        $user->profile->save();

        return redirect()->route('profiles.edit', $user->profile->id);
    }

    public function show(Profile $profile){

        $articles = Article::where([
            ['user_id', $profile->user_id],
            ['status', '1']
        ])->simplePaginate(8);


        return view('subcriber.profiles.show', compact('articles', 'profile'));

    }
}
