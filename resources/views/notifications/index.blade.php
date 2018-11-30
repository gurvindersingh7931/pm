@extends('partials.nav')

@section('body')
	<section>
		<div class="container">
			<div class="columns">
				<div class="column">
					<table class="table">
						<thead>
							<tr>
								<th>Read</th>
								<th>Data</th>
								<th>Project Nam</th>
								<th>Task Name</th>

							</tr>
						</thead>
						<tbody>
							@foreach ($notifications as $notification)
							<tr>
								@if($notification->read_at == null)
								<td><a href="/notifications/read/{{ $notification->id }}">Mark As Read</a></td>
								@else
								<td>Read at {{$notification->read_at}}</td>
								@endif
								<td>{{ $notification->data['message'] }}</td>
								<td>{{ App\Task::find($notification->data['task_id'])->project->name }}</td>
								<td>{{ App\Task::find($notification->data['task_id'])->name }}</td>
							</tr>
							@endforeach	
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
@endsection('content')