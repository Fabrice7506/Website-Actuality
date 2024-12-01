<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Facades\Storage; 
use App\Models\Category;
use App\Models\User;
use Conner\Tagging\Taggable;

class Article extends Model
{
    use HasFactory,HasSlug,Taggable; 
    // Taggable provient du package de Conner
    protected $fillable = [
        'title',
        'slug',
        'image',
        'description',
        'isActive',
        'isComment',
        'isSharable',
        'category_id',
        'author_id',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    public function getRouteKeyName(){
        return 'slug';
    }

    public function imageUrl():string {
        return Storage::url($this->image);
    }

    public function user(){
        return $this->belongsTo(User::class , 'author_id',  'id');
    }
    public function category(){
        return $this->belongsTo(Category::class , 'category_id', 'id');
    }
}
