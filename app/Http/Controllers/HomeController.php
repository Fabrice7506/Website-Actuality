<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\Category;
use App\Models\SocialMedia;

class HomeController extends Controller
{
    public function index(){

        $data = [
            'articles'=>Article::all(),
            'categories'=>Category::all(),
            'global_social'=>SocialMedia::all(),
        ];

        return view('front.home',$data);
    }
}
