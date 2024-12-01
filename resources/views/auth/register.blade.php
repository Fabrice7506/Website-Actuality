@extends('auth.auth-layout')

@section('title' , 'page d\'inscription')


@section('auth_form')
    <h1 class="mb-3">S'inscrire</h1>
			<form action=" {{route('register')}} " method="POST">
                @csrf
				<div class="form-group">
					<input class="form-control" type="text" name="name" placeholder="Nom" value="{{old('Nom')}}"> 
                    @error('Nom')
                        <div class="error text-danger">{{$message}}</div>
                    @enderror
				</div>
				<div class="form-group">
					<input class="form-control" type="text" name="prenoms" placeholder="prenoms" value="{{old('prenoms')}}"> 
                    @error('prenoms')
                            <div class="error text-danger">{{$message}}</div>
                    @enderror
				</div>
				<div class="form-group">
					<input class="form-control" type="email" name="email" placeholder="Email" value="{{old('email')}}"> 
                    @error('email')
                        <div class="error">{{$message}}</div>
                    @enderror
				</div>
				<div class="form-group">
					<input class="form-control" type="password" name="password" placeholder="Mot de passe"> 
                    @error('password')
                        <div class="error text-danger">{{$message}}</div>
                    @enderror
                </div>
				<div class="form-group">
					<input class="form-control" type="password" name="password_confirmation" placeholder="Confirmer Mot de passe"> 
                    @error('password_confirmation')
                         <div class="error text-danger">{{$message}}</div>
                    @enderror
                </div>
				<div class="form-group mb-0">
					<button class="btn btn-primary btn-block" type="submit">S'inscrire</button>
				</div>
			</form>
							
	<div class="text-center dont-have">Vous avez deja un compte? <a href="{{route('login')}}">Se connecter</a> </div>

@endsection