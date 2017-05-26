@extends('layouts.app')

@section('content')
<div class="col-md-12">
	<h4 class="tittle-w3layouts">{{ $title }}</h4>

	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Reporter</th>
					<th>File Label</th>
					<th>Reported at</th>
					<th>Message</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($reports as $report)
					<tr>
						<td>
							@if (! empty($report->user))
								<a href="#">
									{{ $report->user->name }} ({{ $report->user->email }})
									<i class="fa fa-external-link fa-fw"></i>
								</a>
							@else
								{{ $report->name }} ({{ $report->email }})
							@endif
						</td>
						<td>
							<a href="{{ route('file.view', $report->file->uuid) }}">
								{{ $report->file->label }}
							</a>
						</td>
						<td>{{ $report->message }}</td>
						<td>{{ $report->created_at->format('Y-m-d H:i') }}</td>
						<td>{{ ucwords($report->status ) }}</td>
						<td>
							<a href="#" class="btn btn-xs btn-danger" title="Delete file forever">
								<i class="fa fa-trash fa-fw"></i>
							</a>
							<a href="#" class="btn btn-xs btn-success" title="This file was fine">
								<i class="fa fa-check fa-fw"></i>
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		{{ $reports->links() }}
	</div>
</div>
@endsection
