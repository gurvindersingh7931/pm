@extends('partials.nav')

@section('body')
<section>
	<div class="">
		<div class="columns">

			<!-- Display projects -->

			@if(Auth::user()->privilage <= 1)
			<div class="column">
				<div class="table__wrapper">
					<table class="table is-fullwidth">
						<thead>
							<tr class="card">
								<th>Project Name</th>
								<th>Tasks</th>
								<th>Created By</th>
								@can('assign', App\User::class)
								<th>Delete</th>
								@endcan
							</tr>
						</thead>
						<tbody>
							@foreach ($projects as $project)
							<tr class="card">
								<td><a href="/projects/{{$project->id}}">{{ $project->name }}</a></td>
								<td>{{ count($project->tasks) }}</td>
								<td>{{ $project->user->name }}</td>
								@can('delete', $project)
								<td>
									<form method="POST" action="/projects/{{$project->id}}">
										{{ method_field('DELETE') }}
										{{ csrf_field() }}
										<button type="submit" class="btn btn-danger">Delete</button>
									</form>
								</td>
								@endcan

								@cannot('delete', $project)
								<td>
									You can't delete this
								</td>
								@endcannot
							</tr>
							@endforeach	
						</tbody>
					</table>
				</div>
			</div>
			@endif



			<!-- Display Reminders -->

			@if(Auth::user()->can('update', App\Notifications\Reminder::class))
			<div class="column is-one-quarter box" style="margin: 10px">
				<p class="h4 text-center">Reminders</p>
				<table class="table">
					<tbody>
						@if($reminders->count() > 0)

						@foreach($reminders as $reminder)

						<tr>
							@if($reminder->is_strike == 1)
							<td><del>{{ $reminder->data }}</del></td>
							@else
							<td>{{ $reminder->data }}</td>
							@endif
							<td>
								<form method="POST" action="/reminders/{{$reminder->id}}/done">
									{{csrf_field()}}
									
									{{ method_field('PATCH')}}

									<button class="button is-primary" type="submit">Mark as Done</button>
								</form>
							</td>
							@if($reminder->is_strike == 1)
							<td>
								<form method="POST" action="/reminders/{{$reminder->id}}/unstrike">
									{{csrf_field()}}
									<button class="button btn-info" type="submit">Unstrike</button>
								</form>
							</td>
							@else
							<td>
								<form method="POST" action="/reminders/{{$reminder->id}}/strike">
									{{csrf_field()}}
									<button class="button btn-warning" type="submit">Strike</button>
								</form>
							</td>
							@endif

						</tr>	

						@endforeach
						@else

						<a  class="navbar-item" href="#"><p class="h4" style="color: black">No new Reminders</p></a>
						@endif
					</tbody>
				</table>
			</div>
			@endif


			<!-- Display Appointments -->

			@if(Auth::user()->can('update', App\Notifications\Reminder::class))
			<div class="column is-one-quarter box" style="margin: 10px">
				<p class="h4 text-center">Appointments</p>
				<table class="table">
					<tbody>
						@if($appointments->count() > 0)

						@foreach($appointments as $appointment)

						<tr>
							@if($appointment->is_strike == 1)
							<td><del>{{ $appointment->data }}</del></td>
							@else
							<td>{{ $appointment->data }}</td>
							@endif
							<td>
								<form method="POST" action="/appointment/{{$appointment->id}}/done">
									{{csrf_field()}}
									
									{{ method_field('PATCH')}}

									<button class="button is-primary" type="submit">Mark as Done</button>
								</form>
							</td>
							@if($appointment->is_strike == 1)
							<td>
								<form method="POST" action="/appointment/{{$appointment->id}}/unstrike">
									{{csrf_field()}}
									<button class="button btn-info" type="submit">Unstrike</button>
								</form>
							</td>
							@else
							<td>
								<form method="POST" action="/appointment/{{$appointment->id}}/strike">
									{{csrf_field()}}
									<button class="button btn-warning" type="submit">Strike</button>
								</form>
							</td>
							@endif

						</tr>	

						@endforeach
						@else

						<a  class="navbar-item" href="#"><p class="h4" style="color: black">No new  Appointments</p></a>
						@endif
					</tbody>
				</table>
			</div>
			@endif
		</div>

		<div class="columns">
			@if(Auth::user()->privilage == 0)
			<div class="column">
				<p class="title">Tasks</p>
				<table class="table">
					<thead class="is-primary">
						<tr class="card">
							<th>Project Name</th>
							<th>Task</th>
							<th>Progress</th>
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
							<td>{{ $task->progress }} %</td>
							<td><a href="/tasks/{{$task->id}}">Notes</a></td>
							<td>
								@if(count($task->issues) > 0)
								<a href="/tasks/{{$task->id}}/issues">View</a>
								@else
								No Issues
								@endif
							</td>
							<td><a href="/issues/{{$task->id}}/create" class="button is-outlined">Create Issue</a></td>
						</tr>
						<tr class="card"><td><h4>Progress:</h4></td>
							<!-- <div id="progress"></div> -->
							<td colspan="5"><progress class="progress is-warning is-large" data-label="{{$task->progress}}% Complete" value="{{$task->progress}}" max="100">

							</progress>
							<p class="pull-right">100</p>
							<p class="pull-left">0</p>	
						</td>
					</tr>
					<tr class="card"><td><h4>Timeline:</h4></td>
						<!-- <div id="progress"></div> -->
						<td colspan="5"><?php 
						$date1 = new DateTime($task->target);
						$date2 = new DateTime($task->created_at);
						$currentDate = NOW();
						$interval = $date2->diff($currentDate);
						$interva2 = $date1->diff($date2);
						
						?>
						<div>
							<progress class="progress is-warning is-large"  value="{{$interval->days}}" max="{{$interva2->days}}">
							</progress>
							<div>
								<p class="pull-right">{{$task->target}}</p>
								<p class="pull-left">{{$task->created_at}}</p>
								<br>
							</div>
						</div>
					</td>
				</tr>
			@endforeach	
		</tbody>
	</table>
</div>
<div class="column is-one-third">
	<p class="title">Employees</p>

	<table class="table">
		<tbody>
			@foreach($employees as $emp)
			<tr>
				<td>{{$emp->name}}</td>
				<td>
					{{$emp->email}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endif
</div>
</div>
</section>

@stop



<style type="text/css">
.table__wrapper {
	overflow-x: auto;
}
</style>