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
	<form action="{{ route('admin.posts.store') }}" method="post">
		@csrf
		<div class="mb-3">
			<label for="title" class="form-label">Title</label>
			<input type="text" class="form-control" id="title" name="title">
		  </div>
		  <div class="mb-3">
			<label for="content" class="form-label">Content</label>
			<textarea class="form-control" id="content" rows="5" name="content"></textarea>
		  </div>
		  <input type="submit" value="salva">
	</form>
@endsection