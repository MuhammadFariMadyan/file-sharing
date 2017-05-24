@extends('layouts.app')

@section('content')
	<div class="col-md-12">
		<h4 class="tittle-w3layouts">{{ $title }}</h4>

		<div class="well" style="margin-bottom: 20px;">
			<form action="{{ url()->current() }}">
				<div class="form-group">
					<label for="search">Search File</label>
					<input name="query" type="text" class="form-control" value="{{ request('query') }}">
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Search</button>
				</div>
			</form>
		</div>

		@if ($files->total() <= 0)
			<div class="alert alert-info">
				<strong>Information</strong>
				<p>No file uploaded at this time.</p>
			</div>
		@endif

		@foreach ($files as $file)
			<div class="row">
				<div class="col-xs-2">
					<a href="{{ route('file.view', $file->uuid) }}"><i class="fa fa-download fa-3x"></i></a>
				</div>
				<div class="col-xs-10">
					<h5>
						<a href="{{ route('file.view', $file->uuid)  }}">{{ $file->label }}</a>
						@if (! is_null($file->password))
							@if (session()->get('file.'.$file->uuid) == true)
								<small><i class="fa fa-unlock"></i></small>
							@else
								<small><i class="fa fa-lock"></i></small>
							@endif
						@endif
					</h5>
					<p>Size: {{ $file->size / 1000 }} kb, Uploaded: {{ $file->created_at->diffForHumans() }}</p>
					<p>Total Download: {{ $file->downloads_count }} {{ $file->downloads_count <= 1 ? 'time' : 'times' }}</p>
					<p>Uploader: {{ empty($file->user) ? 'Guest' : $file->user->name }}</p>
				</div>
			</div>
			<hr>
		@endforeach
	</div>
@endsection
