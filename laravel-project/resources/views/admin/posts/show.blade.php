@extends('layouts.dashboard')

@section('content')
	<h1>{{ $post->title }}</h1>
	<p>{{ $post->content }}</p>
	<div>
		<ul>
			<li>{{ $post->created_at->format('d F Y')}}</li>
			<li>{{ $post->updated_at('d F Y') }}</li>

		</ul>
	</div>
	<a  class="btn btn-primary" href="{{ route('admin.posts.edit', ['post' => $post->id]) }}">
		Modifica Post
	</a>
	<form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="post">
		@csrf
		@method('DELETE')

		<input type="submit" class="btn btn-danger mt-2" value="Cancella" >
	</form>
@endsection