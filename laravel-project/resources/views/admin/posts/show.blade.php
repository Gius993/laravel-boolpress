@extends('layouts.dashboard')

@section('content')
	<h1>{{ $post->title }}</h1>
	<p>{{ $post->content }}</p>
	<div>
		<ul>
			<li>{{ $post->created_at->format('d F Y')}}</li>
			
		@if ($diff > 0)
			<li>Creato: {{ $diff }} giorn{{ $diff > 1 ? 'i' : 'o'}} fa</li>
		@else
				Creato oggi
		@endif
			
		</ul>
	</div>
	<a  class="btn btn-primary" href="{{ route('admin.posts.edit', ['post' => $post->id]) }}">
		Modifica Post
	</a>
	@if($post->category)
	<div>
		<h3>Categoria: {{ $post->category->name }}</h3>
		
	</div>
	@else
	<div>
		<h3>Nessuna categoria</h3>
	</div>
	@endif
	<form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="post">
		@csrf
		@method('DELETE')

		<input type="submit" class="btn btn-danger mt-2" value="Cancella" onclick="return confirm('sicuro di voler eliminare ?')" >
	</form>
	<div>
		<strong>Tags:</strong>
		@if(($post->tags->isNotEmpty()))
			@foreach ($post->tags as $tag)
				{{ $tag->name }}{{ !$loop->last ? ',' : ''}}
			@endforeach
		@else
		<strong>Nessun tag presente</strong>
		@endif
	</div>
@endsection