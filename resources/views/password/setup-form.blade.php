@extends('layouts.app')

@section('content')
	<div class="col-md-12">
		<h4 class="tittle-w3layouts">{{ $title }}</h4>
		<form action="{{ route('password.setup', $file->uuid) }}" method="post" role="form">
			{{ csrf_field() }}
			{{ method_field('put') }}

			<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
				<label for="password">Password</label>
				<input name="password" type="password" class="form-control">
				<span class="help-block">{{ $errors->first('password') }}</span>
			</div>

			<div class="form-group">
				<button class="btn btn-primary">Save Password</button>
			</div>
		</form>
	</div>
@endsection
