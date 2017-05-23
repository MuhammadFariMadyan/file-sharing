@extends('layouts.app')

@section('content')
	<div class="col-md-12">
		<div class="alert alert-info">
			<strong>Information!</strong>
			<p>Before you can access file "{{ $file->label }}", you must verify given password from author.</p>
		</div>
		<form action="{{ route('password.confirm', $file->uuid) }}" method="post" role="form">
			<input name="id" type="hidden" value="{{ Crypt::encrypt($file->id) }}">
			{{ csrf_field() }}
			{{ method_field('post') }}

			<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
				<label for="password">Password</label>
				<input name="password" type="password" class="form-control">
				<span class="help-block">{{ $errors->first('password') }}</span>
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Verify</button>
			</div>
		</form>
	</div>
@endsection
