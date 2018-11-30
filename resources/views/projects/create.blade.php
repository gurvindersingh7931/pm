@extends('partials.nav')

@section('body')
	<section>
		<div class="container card">
			<form method="POST" action="/projects">
				{{ csrf_field() }}
				<div class="field">
					<label for="name">Project Name</label>
					<div class="control">
						<input type="text" name="name" class="form-control">
					</div>
				</div>
				<div class="field">
					<div class="control">
						<button class="button btn-lg is-primary center-block" type="Submit">Create a project</button>
					</div>
				</div>
				@include('partials.errors')
			</form>
		</div>
	</section>
@endsection