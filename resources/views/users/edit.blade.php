@extends('partials.nav')

@section('body')
	<section>
		<div class="container">
			
			<div class="columns">
				<div class="column is-4 is-offset-4">
					<div class="card" style="margin-top: 64px;">
						<div class="card-content">
							<div class="content">
								<h1 class="has-text-centered">Register</h1>
							</div>
							<form method="POST" action="/users/{{$user->id}}">
								{{ method_field('PATCH') }}
								{{ csrf_field() }}
								@include('partials.status')
								<div class="field">
									<div class="control has-icons-left">
										<input class="input" type="text" name="name" placeholder="Full Name" value="{{ $user->name }}">
										<span class="icon is-left">
										    <i class="fa fa-user"></i>
										</span>
									</div>
								</div>
								<div class="field">
									<div class="control has-icons-left">
										<input class="input" type="email" name="email" placeholder="Email" value="{{ $user->email }}">
										<span class="icon is-left">
										    <i class="fa fa-envelope"></i>
										</span>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="select">
											<select name="privilage">
												@foreach($privilages as $privilage)
													@if($user->privilage == $privilage['value'])
														<option value="{{$privilage['value']}}" selected>{{$privilage['name']}}</option>
													@else
														<option value="{{$privilage['value']}}">{{$privilage['name']}}</option>
													@endif
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<button type="submit" class="button is-full-width">Update Data</button>
									</div>
								</div>
								@include('partials.errors')
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection