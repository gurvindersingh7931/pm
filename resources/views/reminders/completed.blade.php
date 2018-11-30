@extends('partials.nav')

@section('body')
<div class="">
			<h3>Completed Reminders:</h3>
	<div class="columns">

		<!-- Display Completed Reminders -->
		@if(Auth::user()->privilage <= 1)
		<div class="column">
			<div class="table__wrapper">
				<table class="table is-fullwidth">
					<thead>
						<tr class="card">
							<th>Title</th>
							<th>Priority</th>
							<th>Created On</th>
							<th>Completed On</th>
						</tr>
					</thead>
					<tbody>
						@if($reminders->count() > 0)
							@foreach ($reminders as $reminder)
							<tr class="card">
								<td>{{ $reminder->data }}</a></td>
								<td>{{ $reminder->priority }}</td>
								<td>{{ $reminder->created_at }}</td>
								<td>{{ $reminder->updated_at }}</td>
							</tr>
							@endforeach	
						@else
							<tr class="card"><td colspan="4"><center>No Reminders are marked as done yet.</center></td></tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
		@endif
	</div>
</div>

@endsection