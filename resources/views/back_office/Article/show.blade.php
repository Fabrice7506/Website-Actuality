@extends('back_office.app')

@section('title','dashboard - Article')

@section('dashboard-header')
    <div class="row">
                <div class="col-sm-12">
                <h4 class="page-title">Details de l'article</h4> </div>
    </div>

@endsection

@section('dashboard-content')
<div class="row mt-3">
					<div class="col-md-8">
						<div class="blog-view">
							<article class="blog blog-single-post">
								<h3 class="blog-title">{{$articles->title}}</h3>
								<div class="blog-image">
									<a href="blog-details.html"><img alt="" src="{{$articles->imageUrl()}}" class="img-fluid mt-4"></a>
								</div>
								<div class="blog-content mt-4">
									<p>
									{{$articles->description}}
									</p>
							</article>
							<div class="widget author-widget clearfix">
								<h3>A propos de l'auteur</h3>
								<div class="about-author">
									<div class="about-author-img">
										<div class="author-img-wrap"> <img class="img-fluid rounded-circle" alt="" src="{{asset('back_auth/assets/profile/'.$articles->user->image)}}"> </div>
									</div>
									<div class="author-details"> <span class="blog-author-name">{{$articles->user->name}}</span>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
									</div>
								</div>
							</div>
@endsection