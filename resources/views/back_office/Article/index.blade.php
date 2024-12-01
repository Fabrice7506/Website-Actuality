@extends('back_office.app')
@section('title','Article')

@section('dashboard-header')
<div class="row align-items-center">
	<div class="col">
			<div class="mt-5">
				<h4 class="card-title float-left mt-2 ml-3">Articles</h4>
                <a href="{{route('article.create')}}" class="btn btn-primary float-right veiwbutton mr-5">Ajouter un article</a>
            </div>
	</div>
</div>
@endsection

@section('dashboard-content')
<div class="row">
					<div class="col-sm-12">
						<div class="card card-table">
							<div class="card-body booking_card">
								<div class="table-responsive">
									<table class="datatable table table-stripped table table-hover table-center mb-0">
										<thead>
											<tr>
												<th>ID Article</th>
												<th>Image</th>
												<th>Titre</th>
												<th>Categorie</th>
												<th>Date</th>
												<th>Publication</th>
                        <th>Partage</th>
                        <th>Commentaires</th>
												<th>Auteur</th>
												<th class="text-right">Actions</th>
											</tr>
										</thead>
										<tbody>
                                            @foreach ($articles as $article)
                                            
											<tr>
												<td>ART-{{$article->id}}</td>
												<td>
													 <img src="{{$article->imageUrl()}}" width=100>
												</td>
												<td>{{Str::limit($article->title, 20)}}</td>
												<td>{{$article->category->name}}</td>
												<td>{{$article->created_at}}</td>
												<td>
													<div class="actions"> <a href="#" class="btn btn-sm bg-success-light mr-2">{{$article->isActive == 1 ? "Publié" : "Non publié"}}</a> </div>
												</td>
                        <td>
                          <div class="actions"> <a href="#" class="btn btn-sm bg-success-light mr-2">{{$article->isSharable == 1 ? "Active" : "Désactivé"}}</a> </div>
                        </td>
                        <td>
                          <div class="actions"> <a href="#" class="btn btn-sm bg-success-light mr-2">{{$article->isComment == 1 ? "Active" : "Désactivé"}}</a> </div>
                        </td>
												<td>
													<h2 class="table-avatar">
                                                    <a href="profile.html" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{asset('back_auth/assets/profile/'.$article->user->image)}}" alt="User Image"></a>
                                                    <a href="profile.html">{{$article->user->name}} <span>#00{{$article->user->id}}</span></a>
                                                    </h2>
                                                </td>
												<td class="text-right">
													<div class="dropdown dropdown-action"> 
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v ellipse_color"></i>
                            </a>
														<div class="dropdown-menu dropdown-menu-right"> 
                              <a class="dropdown-item" href="{{route('article.show',$article)}}">
                                <i class="fas fa-pencil-alt m-r-5"></i> Voir
                              </a>
                              <a class="dropdown-item" href="{{route('article.edit',$article)}}">
                                <i class="fas fa-pencil-alt m-r-5"></i> Modifier
                              </a> 
                              <form action="{{route('article.destroy',$article)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_asset">
                                    <i class="fas fa-trash-alt m-r-5"></i> Supprimer
                                </button>
                              </form>
                              
                            </div>
													</div>
												</td>
											</tr>
                                     @endforeach   
										</tbody>
									</table>
								</div>
							</div>
						</div>
                        @endsection