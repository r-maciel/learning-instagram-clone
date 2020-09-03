@extends('layouts.app')

@section('content')
<div class="container">
	{{-- enctype="multipart/form-data" for submitting images --}}
	<form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
		@csrf
		<div class="row">
			<div class="col-8 offset-2">
				<div class="form-group row">
		            <h1>Add New Post</h1>
		        </div>
		    </div>
		</div>

		<div class="row">
			<div class="col-8 offset-2">
				<div class="form-group row">
	                <label for="caption" class="col-md-4 col-form-label">Post Caption</label>

	                <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}" autocomplete="caption" autofocus>

	                @error('caption')
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $message }}</strong>
	                    </span>
	                @enderror
	            </div>
			</div>
		</div>

		<div class="row">
			<div class="col-8 offset-2">
				<div class="form-group row">
		            <label for="caption" class="col-md-4 col-form-label">Post Image</label>
		            <input id="image" class="form-control-file" type="file" name="image">

		            @error('image')
		                    <strong>{{ $message }}</strong>
		            @enderror
		        </div>
		    </div>
		</div>

		<div class="row pt-4">
			<div class="col-8 offset-2">
				<div class="form-group row">
		            <button class="btn btn-primary" type="submit">AddNew Post</button>
		        </div>
		    </div>
		</div>
	</form>
</div>
@endsection
