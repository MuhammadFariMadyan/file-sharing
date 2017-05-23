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
				<p>There no file uploaded by you. Upload it first <a class="alert-link" href="{{ route('upload.form') }}">here</a>.</p>
			</div>
		@else
			<div class="alert alert-info">
				<strong>Information</strong>
				<p>All passwords only visible to you.</p>
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
					<p>Password:
						@if (! empty($file->plain_password))
							<span class="text-success">{{ Crypt::decrypt($file->plain_password) }}</span>
							(<a href="{{ route('password.remove', $file->uuid) }}">Remove Password</a>)
						@else
							<i class="fa fa-times fa-fw text-danger"></i>
							(<a href="{{ route('password.setupForm', $file->uuid) }}">Setup Password</a>)
						@endif
					</p>
				</div>
			</div>
			<hr>
		@endforeach
	</div>
@endsection
