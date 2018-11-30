@extends('partials.nav')

@section('body')
<section>
	<div class="container">
		<div class="columns">
			<div class="column is-one-quarter">
				@can('assign', App\User::class)
				<form method="POST" action="/projects/{{ $project->id }}/tasks">
					{{ csrf_field() }}
					<div class="field">
						<label for="name">Task</label>
						<div class="control">
							<input class="input form-control" type="text" name="name" required>
						</div>
					</div>
					<div class="field">
						<label for="User">Employee</label>
						<div class="control">
							<select name="assigned_to" class="form-control">
								@foreach($employees as $employee)
									<option class="form-control" value="{{ $employee->id }}">{{ $employee->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="field">
						<label for="target">Deadline</label>
						<div class="control">
							<input class="input form-control" type="date" name="target">
						</div>
					</div>
					<div class="field">
						<div class="control">
							<button class="button is-primary form-control" type="submit">Create new task</button>
						</div>
					</div>
				</form>
				@else
				<form method="POST" action="/projects/{{ $project->id }}/tasks">
					{{ csrf_field() }}
					<div class="field">
						<label for="name">Task</label>
						<div class="control">
							<input class="input" type="text" name="name">
						</div>
					</div>
					<div class="field">
						<label for="target">Deadline</label>
						<div class="control">
							<input class="input" type="date" name="target">
						</div>
					</div>
					<div class="field">
						<div class="control">
							<button class="button is-primary" type="submit">Create new task</button>
						</div>
					</div>
				</form>	
				@endcan	
			</div>
			<div class="column">
				<div class="content">
					<h1>{{ $project->name }}</h1>
					<table class="table">
						<thead>
							<tr class="card">
								<th>Task</th>
								<th>Progress</th>
								<th>Deadline</th>	
								<th>Assigned To</th>
								<th>Issues</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($project->tasks as $task)
							<tr class="card">
								<td>
									<a href="/tasks/{{$task->id}}">{{$task->name}}</a>
								</td>
								<td>{{ $task->progress }} %</td>
								<td>{{ $task->target->diffForHumans() }}</td>
								<td>{{ $task->user->name }}</td>
								<td>
									@if(count($task->issues) > 0)
									<a href="/tasks/{{$task->id}}/issues">View</a>
									@else
									No Issues
									@endif
								</td>
								<td><a href="/issues/{{$task->id}}/create" class="button is-outlined form-control">Create Issue</a></td>
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