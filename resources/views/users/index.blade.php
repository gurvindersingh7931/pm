@extends('partials.nav')

@section('body')
<div class="container">
	<div class="content">
		<table class="table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Privilage</th>
					<th>Edit</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
					<tr>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						@if($user->privilage == 0)
						<td>Super Admin</td>
						@elseif($user->privilage == 1)
						<td>Manager</td>
						@elseif( $user->privilage == 2)
						<td>Employee</td>
						@else
						<td>Blocked</td>
						@endif
						@if($user->id != 1 || auth()->user()->id == $user->id)
						<td><a href="/users/{{ $user->id }}/edit">Edit User</a></td>
						@else
						<td><span class="badge badge-pill badge-danger">You can't edit this user.</span></td>
						@endif
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection