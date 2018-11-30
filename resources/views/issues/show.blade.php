@extends('partials.nav')

@section('body')
<section>
	<div class="container">
		<div class="columns">
			<div class="column">
				<div class="content">
					<h1>
						@if($issue->is_resolved)
						<span class="icon has-text-success">
						  <i class="fa fa-check-square"></i>
						</span>
						@else
						<span class="icon has-text-danger">
						  <i class="fa fa-ban"></i>
						</span>
						@endif
						{{$issue->title}}
					</h1>
					<p>{{$issue->description}}</p>
					@can('update', $issue)
					<form method="POST" action="/issues/{{$issue->id}}">
						{{ csrf_field() }}
						{{ method_field('PATCH') }}
						@if($issue->is_resolved)
						<button class="button is-success">Re-open Issue</button>
						@else
						<button type="Submit" class="button is-danger">Mark as Resolved</button>
						@endif
					</form>
					@endcan
				</div>
				<hr>
				<article class="media">
					<div class="media-content">
						<div class="content">
							@foreach($issue->comments as $comment)
							<p>
								<strong>{{App\User::find($comment->created_by)->name}}</strong> <small>{{$comment->created_at->diffForHumans()}}</small>
								<p>{{$comment->body}}</p>
								@can('delete', $comment)
								<form method="POST" action="/comments/{{$comment->id}}">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<button type="Submit" class="button is-danger">
										<span class="icon is-small">
										  <i class="fa fa-trash"></i>
										</span>
									</button>
								</form>
								@endcan
							</p>
							@endforeach			
						</div>
					</div>
				</article>
				@if(!$issue->is_resolved)
				<article class="media">
					<div class="media-content">
						
						<form method="POST" action="/issues/{{$issue->id}}/comments">
							{{ csrf_field() }}
							<div class="field">
								<textarea class="textarea" name="body"></textarea>
							</div>
							<div class="field">
								<button class="button is-primary" type="Submit">Add comment</button>
							</div>
						</form>
					</div>
				</article>
				@endif
			</div>
		</div>
	</div>
</section>
@endsection