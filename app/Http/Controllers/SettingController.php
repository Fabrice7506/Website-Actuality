<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('back_office.setting.index',['Setting' => Setting::where('id',1)->first()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function update(StoreSettingRequest $request)
    {
        // Valider la requête avant d'utiliser les données
         $request->validated();
    
        // Récupérer le premier paramètre de configuration avec l'ID 1
        $Setting = Setting::where('id', 1)->first(); 
    
        // Vérifier si le paramètre existe
   
        // Récupérer le logo à partir de la requête
        $logo = $request->logo;
    
        // Utiliser l'ancien logo par défaut si aucun nouveau logo n'est fourni
        $imagePath = $Setting->logo ?? null;
    
        // Si un nouveau logo est soumis et est valide
        if ($logo != null && $logo->isValid()) {
            // Supprimer l'ancien logo s'il existe dans le stockage
            if ($Setting->logo) {
                Storage::disk('public')->delete($Setting->logo);
            }
            // Enregistrer le nouveau logo et mettre à jour le chemin
            $imagePath = $logo->store('asset', 'public');
        }
    
        // Mettre à jour les paramètres du modèle avec les nouvelles valeurs
        $Setting->update([
            'name' => $request->name,
            'logo' => $imagePath,
            'Adresse' => $request->Adresse,
            'contact' => $request->contact,
            'email' => $request->email,
            'description' => $request->description // Correction de la faute d'orthographe
        ]);
        return back()->with('success','Paramètre mise à jours');
    }
    

   
   
}
