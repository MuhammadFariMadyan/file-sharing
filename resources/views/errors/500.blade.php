@extends('layouts.app')

@section('content')
	<div class="col-md-12 text-center">
		<div class="row" style="margin-bottom: 50px;">
			<h1>{{ $exception->getStatusCode() }}</h1>
			<h3>{{ $exception->getMessage() }}</h3>

			<a href="{{ route('file.index') }}" class="btn btn-default">Go to Catalog</a>
		</div>
	</div>
@endsection
