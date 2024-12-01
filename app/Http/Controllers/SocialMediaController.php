<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use App\Http\Requests\StoreSocialMediaRequest;
use App\Http\Requests\UpdateSocialMediaRequest;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('back_office.social_media.index',['media'=>SocialMedia::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back_office.social_media.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSocialMediaRequest $request)
    {
        $request->validated();

        SocialMedia::create($request->all());

        return redirect()->route('SocialMedia.index')->with('success','Social Media Ajouter avec success');
    }

    /**
     * Display the specified resource.
     */
    public function show(SocialMedia $socialMedia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialMedia $SocialMedia)
    {
        return view('back_office.social_media.edit',['medias'=>$SocialMedia]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSocialMediaRequest $request, SocialMedia $SocialMedia)
    {
        $request->validated();
        
        $SocialMedia->update($request->all());
        return redirect()->route('SocialMedia.index')->with('success','Social Media Modifier avec success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialMedia $SocialMedia)
    {
        $SocialMedia->delete();

        return redirect()->route('SocialMedia.index')->with('success','Social Media supprimer avec success');

    }
}
