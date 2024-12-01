<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleUserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $data =  [
            'users'=> User::where('role','author')->get(),
    ];
        return view('back_office.author.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back_office.author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleUserRequest $request)
    {
       $request->validated();

       User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>hash::make('12345678'),
       ]);

       return redirect()->route('Author.index')->with('success',' Auteur enregistré avec succes');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $Author){
       
        $data = [
            'user'=>$Author,
        ];

        return view('back_office.author.edit',$data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUserRequest $roleUserRequest ,User $Author)
    {
        $roleUserRequest->validated();
        $Author->update([
            'name'=>$roleUserRequest->name,
            'email'=>$roleUserRequest->email,
        ]);

        return redirect()->route('Author.index')->with('success',' Modification enregistré avec succes');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $Author)
    {
        $Author->delete();
        
        return redirect()->route('Author.index')->with('success',' Auteur supprimer');

    }
}
