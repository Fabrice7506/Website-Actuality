<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role == 'admin'){
            $article = Article::all();
        }
        else{
            $article = Article::where('author_id',Auth::id())->get();
        }

        $data = [
            'articles'=>$article,
        ];
        return view('back_office.Article.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back_office.Article.create',['category'=>Category::where('isActive',1)->get()]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $request->validated();

        $image = $request->image;

        if($image != null && !$image->getError()){
            $image = $request->image->store('asset','public');
        }


        $article = Article::create([
            'title'=>$request->title,
            'description' => $request->description,
            'isActive'=>$request->isActive,
            'isComment'=>$request->isComment,
            'isSharable'=>$request->isSharable,
            'image'=>$image,

            'category_id'=>$request->category_id,
            'author_id'=>Auth::user()->id,
        ]);


        return redirect()->route('article.index')->with('success','Article enregistré avec succes');

    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $data = [
            'articles' => $article,
        ];

        return view('back_office.Article.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $data = [
            'articles' => $article,
            'category' => Category::where('isActive',1)->get(),
        ];

        return view('back_office.Article.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(StoreArticleRequest $request, Article $article)
    // {
    //     $request->validated();

    //     $image = $request->image;

    //     $imagePath = $article->image;

    //     if($image != null && !$image->getError()){
    //         if($article->image){
    //             Storage::disk('public')->delete($article->image);
    //         }
    //         $imagePath = $request->image->store('asset', 'public');
    //     }

    //     $tags = explode(',',$request->tags);

    //     $article->update([
    //         'title'=>$request->title,
    //         'description' => $request->description,
    //         'isActive'=>$request->isActive,
    //         'isComment'=>$request->isComment,
    //         'isSharable'=>$request->isSharable,
    //         'image'=>$image,

    //         'category_id'=>$request->category_id,
    //         'author_id'=>Auth::user()->id,
    //     ]);

    //     $article->tag($tags);

    //     return redirect()->route('article.index')->with('success','Article modifier avec succes');

        
    // }
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $request->validated();
    
        $image = $request->image;
    
        // Conserver le chemin de l'ancienne image si aucune nouvelle image n'est fournie
        $imagePath = $article->image; // Utiliser l'ancienne image par défaut
    
        if ($image != null && $image->isValid()) {
            // Supprimer l'ancienne image du stockage si elle existe
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            // Stocker la nouvelle image
            $imagePath = $request->image->store('asset', 'public');
        }
    
        $tags = explode(',', $request->tags);
    
        $article->update([
            'title' => $request->title,
            'description' => $request->description,
            'isActive' => $request->isActive,
            'isComment' => $request->isComment,
            'isSharable' => $request->isSharable,
            'image' => $imagePath, // Met à jour avec le chemin de l'ancienne image si pas de nouvelle
            'category_id' => $request->category_id,
            'author_id' => Auth::user()->id,
        ]);
    
        // Mettre à jour les tags
        $article->tag($tags);
    
        return redirect()->route('article.index')->with('success', 'Article modifié avec succès');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return back()->with('success','Article supprimer avec succes');
    }
}
