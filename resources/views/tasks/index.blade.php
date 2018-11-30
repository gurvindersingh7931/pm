@extends('partials.nav')

@section('body')
	<section>
		<div class="container">
			<div class="columns">
				<div class="column">
					<div class="content">
						<h1>My Tasks</h1>
						<table class="table">
							<thead class="is-primary">
								<tr class="card">
									<th>Project Name</th>
									<th>Task</th>
									<th>Progress</th>
									<th>Deadline</th>
									<th>Start Date</th>
									<th>Notes</th>
									<th>Issues</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($tasks as $task)
								<tr class="card">
									<td>{{ $task->project->name }}</td>
									<td>{{ $task->name }}</td>
									<td>{{ $task->progress }} </td>
									<td>{{ $task->target }}</td>
									<td>{{ $task->created_at }} </td>
									<td><a href="/tasks/{{$task->id}}">Notes</a></td>
									<td>
										@if(count($task->issues) > 0)
										<a href="/tasks/{{$task->id}}/issues">View</a>
										@else
										No Issues
										@endif
									</td>
									<td><a href="/issues/{{$task->id}}/create" class="button is-outlined">Create Issue</a><a href="/task/create/{{$task->project_id}}" class="button is-outlined">Create Task</a></td>
								</tr>
								@endforeach	
							</tbody>
						</table>
					</div>	
				</div>
			</div>
		</div>
	</section>
@endsection