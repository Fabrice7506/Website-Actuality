@extends('back_office.app')
@section('title','Paramètres')


@section('dashboard-content')
<div class="row">
            <div class="col-lg-12">
              <form action="{{route('parametre.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h3 class="page-title">Paramètres de base</h3>
                <div class="row mt-4">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label
                        >Nom du site <span class="text-danger">*</span></label
                      >
                      <input class="form-control" type="text" value="{{ isset($Setting) ? $Setting->name : old('name')}}" name="name"/>
                      @error('name')
                        <div class="error text-danger">{{$message}}</div>
                    @enderror
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Uploader une image</label>
                      <div class="custom-file mb-3">
                        <input
                          type="file"
                          class="custom-file-input"
                          id="customFile"
                          name="logo"
                        />
                        <label class="custom-file-label" for="customFile"
                          >Choisir une image</label
                        >
                      </div>
                      @error('logo')
                        <div class="error text-danger">{{$message}}</div>
                    @enderror
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Address</label>
                      <input
                        class="form-control"
                        value="{{ isset($Setting) ? $Setting->Adresse : old('adresse')}}"
                        type="text"
                        name ="Adresse"
                      />
                      @error('Adresse')
                        <div class="error text-danger">{{$message}}</div>
                    @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Numero de telephone</label>
                      <input
                        class="form-control"
                        value="{{ isset($Setting) ? $Setting->contact : old('contact')}}"
                        type="tel"
                        name="contact"
                      />
                      @error('contact')
                        <div class="error text-danger">{{$message}}</div>
                    @enderror
                    </div>
                  </div>
                  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Email</label>
                      <input
                        class="form-control"
                        value="{{ isset($Setting) ? $Setting->email : old('email')}}"
                        type="text"
                        name="email"
                      />
                      @error('email')
                        <div class="error text-danger">{{$message}}</div>
                    @enderror
                    </div>
                  </div>
                  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Description</label>
                      <textarea
                        class="form-control"
                        rows="5"
                        id="comment"
                        name="description"
                      >{{ isset($Setting) ? $Setting->description : old('description')}}</textarea>
                    </div>
                  </div>
                  
                </div>
                <button type="submit" class="btn btn-primary buttonedit mr-5 mt-5">
                Save
              </button>
              </form>
            </div>
          </div>
        </div>
       
      
@endsection