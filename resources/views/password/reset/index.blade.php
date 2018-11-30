@extends('partials.nav')

@section('body')
<section>
	<div class="container">
		<div class="columns">
			<!-- Change Password -->
			<div class="column is-4">
				<div class="card" style="margin-top: 64px;">
					<div class="card-content">
						<div class="content">
							<h1 class="has-text-centered">Change Your Password</h1>
						</div>
						<form method="POST" action="/password/reset">
							{{ csrf_field() }}
							<div class="field">
								<div class="control has-icons-left">
									<!-- <p class="h5">Old Password:</p> -->
									<input class="input form-control" type="text" name="old" placeholder="Old Password" required>
								</div>
							</div>
							<div class="field">
								<div class="control has-icons-left">
									<input placeholder="New Password" class="input form-control" name="password" id="password" type="password" onkeyup='check();' required/>
								</div>
							</div>
							<div class="field">
								<div class="control has-icons-left">
									<input class="input form-control" placeholder="Confirm New Password" type="password" name="confirm_password" id="confirm_password"  onkeyup='check();' required/> 
									<div class="text-center">
										<br>
										<span class="h4 is-capitalized" id='message'></span>
									</div>
								</div>
							</div>
							<div class="field">
								<div class="control">
									<button type="submit" class="button is-full-width is-primary form-control" id="btnSubmit">Update Password</button>
								</div>
							</div>
							@include('partials.errors')
						</form>
					</div>
				</div>
			</div>
			<!-- Change Name -->
			<div class="column is-4">
				<div class="card" style="margin-top: 64px;">
					<div class="card-content">
						<div class="content">
							<h1 class="has-text-centered">Change Name</h1>
						</div>
						<form method="POST" action="/name/reset">
							{{ csrf_field() }}
							<div class="field">
								<div class="control has-icons-left">
									<!-- <p class="h5">Old Password:</p> -->
									<input class="input form-control" type="text" name="name" placeholder="Name" required>
								</div>
							</div>
							<div class="field">
								<div class="control">
									<button type="submit" class="button is-full-width is-primary form-control" id="btnSubmit">Update Name</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			@if(Auth::user()->can('update', App\Notifications\Reminder::class))
			<div class="column is-one-sixth box" style="margin: 10px">
				<p class="h4 text-center">Password Reset Requests</p>
				<table class="table">
					<tbody>
						@if(count(Auth::user()->unreadNotifications->where('type', 'App\Notifications\ForgotPassword')) > 0)
						@foreach(Auth::user()->unreadNotifications as $notification)
						@if($notification->type == App\Notifications\ForgotPassword::class)
						<tr>
							<td>{{$notification['data']['email']}} wants to reset Password.</td>
							<td>
								<form method="POST" action="/forgotPassword/{{$notification->id}}/done">
									{{csrf_field()}}
									{{ method_field('PATCH')}}
									<input type="hidden" name="id" value="{{$notification['data']['id']}}">
									<input type="password" name="password" placeholder="Enter new Password" class="form-control-file">
									<button class="button is-primary btn-sm" type="submit">Update and Mark as Done</button>

								</form>
							</td>
						</tr>
						@endif
						@endforeach
						@else
						<a  class="navbar-item" href="#"><p class="h4" style="color: black">No new Requests</p></a>
						@endif
					</tbody>
				</table>
			</div>
			@endif
		</div>
	</div>
</section>

<script type="text/javascript">
	var check = function() {
		if (document.getElementById('password').value ==
			document.getElementById('confirm_password').value) {
			document.getElementById('message').style.color = 'green';
		document.getElementById('message').innerHTML = 'matching';
	} else {
		document.getElementById('message').style.color = 'red';
		document.getElementById('message').innerHTML = 'not matching';
	}
}
</script>

@endsection
