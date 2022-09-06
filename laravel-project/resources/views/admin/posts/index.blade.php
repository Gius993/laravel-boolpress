@extends('layouts.dashboard')
{{-- @if ($show_deleted_message === 'yes')
<div class="alert alert-success" role="alert">
	Post cancellato
  </div>
@endif --}}
@section('content')
  @foreach ($posts as $post)
 
  	<h1>{{ $post->title}}</h1>
	  <p>{{ $post->content }}</p>
	  <a class="nav-link active" href="{{ route('admin.posts.show', ['post' => $post->id]) }}">
		Guarda dettaglio
	  </a>
	  @endforeach
@endsection