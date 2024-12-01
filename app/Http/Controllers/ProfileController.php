<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     if($request->hasfile('image')){
    //         if(file_exists(public_path('back_auth/profile/'.$request->user()->image)) AND !empty($request->user()->image)){
    //             unlink(public_path('back_auth/profile'.$request->user()->image));
    //         }  
    //     }

    //     $ext = $request->file('image')->extension();
    //     $file_name = date('YmdHis').'.'.$ext;

    //     $request->file('image')->move(public_path('back_auth/assets/profile'),$file_name);

    //     $request->user()->image= $file_name;
    //     $request->user()->name= $request->name;
    //     $request->user()->email= $request->email;

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('success', 'profile modifier avec succes');
    // }
    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    // Met à jour les champs validés de l'utilisateur
    $request->user()->fill($request->validated());

    // Si l'email est modifié, réinitialiser l'état de vérification
    if ($request->user()->isDirty('email')) {
        $request->user()->email_verified_at = null;
    }

    // Vérifie si une nouvelle image a été téléchargée
    if($request->hasFile('image')){
        // Supprime l'ancienne image si elle existe
        if(file_exists(public_path('back_auth/profile/'.$request->user()->image)) && !empty($request->user()->image)){
            unlink(public_path('back_auth/profile/'.$request->user()->image));
        }  

        // Récupère l'extension et génère un nouveau nom de fichier
        $ext = $request->file('image')->extension();
        $file_name = date('YmdHis').'.'.$ext;

        // Déplace la nouvelle image dans le dossier approprié
        $request->file('image')->move(public_path('back_auth/assets/profile'), $file_name);

        // Mets à jour le champ image de l'utilisateur
        $request->user()->image = $file_name;
    }

    // Mets à jour les autres champs (name et email)
    $request->user()->name = $request->name;
    $request->user()->email = $request->email;

    // Sauvegarde les modifications de l'utilisateur
    $request->user()->save();

    // Redirige avec un message de succès
    return Redirect::route('profile.edit')->with('success', 'Profile modifié avec succès');
}


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
