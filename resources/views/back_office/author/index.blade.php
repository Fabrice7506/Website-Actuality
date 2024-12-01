@extends('back_office.app')
@section('title','Liste des auteurs ')

@section('dashboard-header')
<div class="row align-items-center">
              <div class="col">
                <div class="mt-5">
                  <h4 class="card-title float-left mt-2">Les Auteurs</h4>
                  <a
                    href="{{route('Author.create')}}"
                    class="btn btn-primary float-right veiwbutton"
                    >Ajouter un auteur</a
                  >
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
                    <table
                      class="datatable table table-stripped table table-hover table-center mb-0"
                    >
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nom</th>
                          <th>Email</th>
                          <th class="text-right">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          @foreach ($users as $user)
                         
                          <td>AUT-00{{$user->id}}</td>
                          <td>
                            <h2 class="table-avatar">
                              <a
                                href="profile.html"
                                class="avatar avatar-sm mr-2"
                                ><img
                                  class="avatar-img rounded-circle"
                                  src="{{('back_auth/assets/profile/'.$user->image)}}"
                                  alt="User Image"
                              /></a>
                              <a href="profile.html">{{$user->name}} </a>
                            </h2>
                          </td>

                          <td>{{$user->email}}</td>

                          <td class="text-right">
                            <div class="dropdown dropdown-action">
                              <a
                                href="#"
                                class="action-icon dropdown-toggle"
                                data-toggle="dropdown"
                                aria-expanded="false"
                                ><i class="fas fa-ellipsis-v ellipse_color"></i
                              ></a>
                              <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{route('Author.edit',$user)}}"
                                  ><i class="fas fa-pencil-alt m-r-5"></i>
                                  Modifier</a
                                >
                                <form action="{{route('Author.destroy',$user)}}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button
                                  class="dropdown-item"
                                  type="submit"
                                  data-toggle="modal"
                                  data-target="#delete_asset"
                                  ><i class="fas fa-trash-alt m-r-5"></i>
                                  Supprimer</button>
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
            </div>
          </div>
@endsection