@extends('partials.nav')

@section('body')
<section>
	<div class="container text-center">
		<div class="columns is-multiline">
			@foreach($users as $user)
			<div class="column is-one-quarter">
				<article class="box">
					<p class="title">{{ $user->name }}</p>
					<!-- @foreach($user->unreadNotifications as $notification) -->
					<!-- {{$notification['data']['message']}} -->
					<!-- @endforeach -->
					<form method="POST" action="users/{{$user->id}}/reminders">
						{{csrf_field()}}
						<input type="text" name="message" class="form-control">
						<label class="" for="priority">Select Priority</label>
						<select class="form-control" name="priority" id="priority">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select>
						<br>
						<button type="submit" class="button is-primary">Create Reminder</button>
					</form>
				</article>
			</div>
			@endforeach
		</div>
	</div>
</section>
@endsection