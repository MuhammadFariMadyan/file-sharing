@extends('layouts.app')

@section('content')
<div class="col-md-12">

	<div class="text-center">
		<h2>Your file is ready!</h2>
		<hr>

		@if (! empty($file->expired_at))
			<div class="alert alert-warning">
				<p>This file will expired at <strong>{{ $file->expired_at->format('Y-m-d H:i') }}</strong>.</p>
			</div>
		@endif

		<a href="{{ route('file.download', $file->uuid) }}">
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

		<h5 style="margin-top: 20px">Total Download: {{ $file->downloads_count }}  {{ $file->downloads_count <= 1 ? 'time' : 'times' }}</h5>

		<div class="row" style="margin-top: 10px;">
			<a type="button" data-toggle="modal" data-target="#reportFile" data-toggle="" class="btn btn-warning">
				<i class="fa fa-exclamation-triangle fa-fw"></i>
				Report File
			</a>
		</div>
	</div>

	<div class="clearfix" style="margin-bottom: 20px"></div>

	@if (app()->environment('production'))
		<div class="row">
			@include('partials.ads.responsive')
		</div>
	@endif

	<div class="clearfix" style="margin-bottom: 20px"></div>

	<hr>
	@if($file->type == 'image')
		<div class="form-group">
			<label for="file">Direct Path</label>
			<input type="text" class="form-control" value="{{ asset(preg_replace('/\/{2,}/', '', Storage::url($file->path))) }}">
		</div>
	@endif

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

	@if (auth()->check())
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
	@endif

</div>

<div class="modal fade" tabindex="-1" id="reportFile" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Report File</h4>
      </div>
      <form action="{{ route('report.submit', $file->uuid) }}" method="post" role="form">
      	{{ csrf_field() }}
      	{{ method_field('post') }}

      	<input type="hidden" name="uuid" value="{{ $file->uuid }}">

	      <div class="modal-body">
	      	@if (!auth()->check())
		      	<div class="form-group">
		      		<label for="name">Name</label>
		      		<input name="name" type="text" class="form-control">
		      	</div>

				<div class="form-group">
					<label for="email">Email</label>
					<input name="email" type="email" class="form-control">
				</div>
			@endif

			<div class="form-group">
				<label for="message">Message</label>
				<textarea name="message" id="message" rows="5" class="form-control"></textarea>
			</div>
	      </div>

	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Send</button>
	      </div>
      </form>
    </div>
  </div>
</div>
@endsection
