@extends('layouts.app')

@section('content')
	<div class="col-md-12">

		<div class="text-center">
			<h2>Your file is ready!</h2>
			<hr>
			<a href="{{ $file->download }}">
				<h1 style="margin-bottom:20px">
					@if (array_key_exists($file->extension, config('file.mimes')))
						<i class="fa fa-5x fa-{{ config('file.mimes')[$file->extension] }}"></i>
					@else
						<i class="fa fa-5x fa-download"></i>
					@endif
				</h1>
			</a>
			<h3>
				{{ $file->label }}
				@if (! is_null($file->password))
					@if (session()->get('file.'.$file->uuid) == true)
						<small><i class="fa fa-unlock"></i></small>
					@else
						<small><i class="fa fa-lock"></i></small>
					@endif
				@endif
			</h3>
			<p>Size: {{ $file->size / 1000 }} kb, Uploaded: {{ $file->created_at->diffForHumans() }}, Uploaded by: {{ empty($file->user) ? 'Guest' : $file->user->name }}</p>

			<h5 style="margin-top: 20px">Total Downloads: {{ $file->downloads_count }}  {{ $file->downloads_count <= 1 ? 'time' : 'times' }}</h5>
		</div>

		<div class="clearfix" style="margin-bottom: 20px"></div>

		<div class="row">
			@include('partials.ads.responsive')
		</div>

		<div class="clearfix" style="margin-bottom: 20px"></div>

		<hr>
		<div class="form-group">
			<label for="share">Direct Link</label>
			<input type="text" class="form-control" value="{{ $file->download }}">
		</div>

		<div class="form-group">
			<label for="markdown">Markdown</label>
			<input type="text" class="form-control" value="[Download {{ $file->label }}]({{ $file->download }})">
		</div>

		<div class="form-group">
			<label for="bbcode">BBCode</label>
			<input type="text" class="form-control" value="[url={{ $file->download }}]Download {{ $file->label }}[/url]">
		</div>

		<form action="{{ route('file.delete', $file->uuid) }}" method="post">
			{{ csrf_field() }}
			{{ method_field('delete') }}

			<div class="form-group">
				<button class="btn btn-danger">
					<i class="fa fa-times"></i>
					Delete File
				</button>
			</div>
		</form>
	</div>
@endsection
