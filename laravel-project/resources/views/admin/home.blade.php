@extends('layouts.dashboard')

@section('content')
	<h1>Ciao utente</h1>

	<div>
		Benvenuto {{ $user->name }}
		con email {{ $user->email }}		
	</div>
	
@endsection