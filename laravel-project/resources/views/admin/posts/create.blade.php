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
	<form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
		@csrf
		<div class="mb-3">
			<label for="title" class="form-label">Title</label>
			<input type="text" class="form-control" id="title" name="title">
		  </div>
		  <div class="mb-3">
           	<label for="category_id"></label>
				  <select class="form-select" id="category_id" name="category_id">
					 <option value="">Nessuna</option>
					@foreach ($categories as $category)
						<option 
						value="{{ $category->id }}">
						{{ $category->name }}
					</option>
					 @endforeach
				 </select>
		  </div>
		<h5>Tags</h5>
		@foreach($tags as $tag)
		  <div class="form-check mb-3">
			<input 
			class="form-check-input" 
			type="checkbox" 
			id="tag-{{$tag->id}}" 
			value="{{ $tag->id }}"
			name="tags[]"
			{{ in_array($tag->id, 
			old('tags', [])) 
			? 'checked' 
			: '' }}
			>
			<label 
			class="form-check-label" 
			for="tag-{{$tag->id}}"
			>
			  {{ $tag->name }}
			</label>
		  </div>
		@endforeach
		  <div class="mb-3">
			<label for="content" class="form-label">Content</label>
			<textarea class="form-control" id="content" rows="5" name="content"></textarea>
		  </div>
		  <div class="mb-3">
			<label class="form-label p-3" for="image">Carica un file</label>
			<input type="file" class="form-control" id="image" name="image" />
		  </div>
		  <input type="submit" value="salva">
	</form>
@endsection