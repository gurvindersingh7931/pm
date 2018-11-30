@extends('layout')

@section('content')
	<section class="hero is-primary">
		<div class="container">
			<div class="columns">
				<div class="column is-4 is-offset-4">
					<div class="card" style="margin-top: 64px;">
						<div class="card-content">
							<div class="content">
								<h1 class="has-text-centered">Sign In</h1>
							</div>
							<form method="POST" action="/login">
								{{ csrf_field() }}
								<div class="field">
									<div class="control has-icons-left">
										<input class="input form-control" type="email" name="email" placeholder="Email">
										<span class="icon is-left">
										    <i class="fa fa-envelope"></i>
										</span>
									</div>
								</div>
								<div class="field">
									
									<div class="control has-icons-left">
										<input class="input form-control" type="password" name="password" placeholder="Password">
										<span class="icon is-left">
										    <i class="fa fa-key"></i>
										</span>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<button type="submit" class="button is-primary form-control">Login</button>
									</div>
								</div>
								<div class="has-text-centered"><a href="/forgotPassword">Forgot your password?</a></div>
								<div class="has-text-centered">Not yet a member? <a class="form-control" href="/register">Register</a></div>
								@include('partials.errors')
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection