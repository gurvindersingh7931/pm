@extends('partials.nav')

@section('body')
<div class="">
			<h3>Completed Appointments:</h3>
	<div class="columns">

		<!-- Display Completed Appointments -->
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
						@if($appointments->count() > 0)
						@foreach ($appointments as $appointment)
						<tr class="card">
							<td>{{ $appointment->data }}</a></td>
							<td>{{ $appointment->priority }}</td>
							<td>{{ $appointment->created_at }}</td>
							<td>{{ $appointment->updated_at }}</td>
						</tr>
						@endforeach	
						@else
							<tr class="card"><td colspan="4"><center>No Appointments are marked as done yet.</center></td></tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
		@endif
	</div>
</div>

@endsection