@extends('back_office.app')
@section('title','Ajoute de Media Social')

@section('dashboard-header')
<div class="row align-items-center">
              <div class="col">
                <h3 class="page-title mt-5">Ajouter une un reseau social</h3>
              </div>
            </div>
@endsection
@section('dashboard-content')
<div class="row">
            <div class="col-lg-12">
              <form action="{{route('SocialMedia.store')}}" method="POST">
                @csrf
                <div class="row formtype">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Nom du reseau</label>
                      <input
                        class="form-control"
                        type="text"
                        name="name"
                      />
                    </div>
					</div>
                  </div>
				      <div class="col-md-4">
                    <div class="form-group">
                      <label>Lien</label>
                      <input
                        class="form-control"
                        type="text"
                        name="link"
                      />
                    </div>
                  </div>
				          <div class="col-md-4">
                    <div class="form-group">
                      <label>Icon</label>
                      <input
                        class="form-control"
                        type="text"
                        name="icon"
                      />
                    </div>
                  </div>
                </div>
				<button type="submit" class="btn btn-primary buttonedit1">
            Enregistrer
          </button>
              </form>
            </div>
@endsection