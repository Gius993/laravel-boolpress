@extends('layouts.dashboard')

@section('content')
	<h1>crea un post</h1>
	@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
	<form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="post">
		@csrf
		@method('PUT')
		<div class="mb-3">
			<label for="title" class="form-label">Titolo</label>
			<input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
		  </div>
		  <div class="mb-3">
			<label for="content" class="form-label">Contenuto</label>
			<textarea class="form-control" id="content" rows="5" name="content">{{ $post->content }}</textarea>
		  </div>
		  <input type="submit" value="modifica">
	</form>
@endsection