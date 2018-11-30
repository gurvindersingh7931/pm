@extends('partials.nav')

@section('body')
<section>
	<div class="container">
		<div class="columns">
			<div class="column"></div>
			<div class="column">
				<form method="POST" action="/tasks/{{$task->id}}/issues">
					{{ csrf_field() }}
					<div class="field">
						<label for="title">Issue Title</label>
						<div class="control">
							<input id="title" type="text" name="title" class="input form-control">
						</div>
					</div>
					<div class="field">
						<label for="body">Description</label>
						<div class="control">
							<textarea id="body" name="body" class="textarea form-control"></textarea>
						</div>
					</div>
					<div class="field">
						<button type="submit" class="button is-primary form-control">Create Issue</button>
					</div>
					
				</form>
			</div>
			<div class="column">
			</div>
		</div>
	</div>
</section>
@endsection