@extends('partials.nav')

@section('body')
<section>
	<div class="container">
		<a class="button is-full-width is-outlined btn-success" href="/issues/{{$task->id}}/create" style="font-size: 20px">Open a new Issue</a>
		<div class="columns" style="margin-top: 16px;">
			<div class="column">
						@foreach($task->issues as $issue)
							<div class="card" style="margin-top: 16px">
								<header class="card-header">
									<p class="card-header-title">
										{{$issue->title}}
									</p>
								</header>
								<div class="card-content">
									<div class="content">
										{{$issue->description}}
										<br>
										<time>{{ $issue->created_at->diffForHumans() }}</time>
									</div>
								</div>
								<footer class="card-footer">
								<div class="card-footer-item">
									Status:
								@if($issue->is_resolved)
								<span class="icon has-text-success">
								  <i class="fa fa-check-square"></i>
								</span>
								@else
								<span class="icon has-text-danger">
								  <i class="fa fa-ban"></i>
								</span>
								@endif		
								</div>
								<a href="/tasks/{{$task->id}}/issues/{{$issue->id}}" class="card-footer-item">View</a>
								<div class="card-footer-item">Created By: {{ App\User::find($issue->user_id)->name }}</div>
								</footer>
							</div>
						
						@endforeach
					
				</table>
			</div>
		</div>
	</div>
</section>
@endsection