@extends('partials.nav')

@section('body')
	<section>
		<div class="container">
			<div class="columns">
				<div class="column is-one-quarter">
					<canvas id="indicator"></canvas>
					<!-- <form method="POST" action="/tasks/{{ $task->id }}/notes">
						{{ csrf_field() }}
						<div class="field">
							<label for="body">Note</label>
							<div class="control">
								<input class="input" type="text" name="body">
							</div>
						</div>
						<div class="field">
							<button type="submit" class="button is-primary">Add note</button>
						</div>
					</form> -->
					<form method="POST" action="/tasks/{{ $task->id }}">
						{{ method_field('PATCH') }}
						{{ csrf_field() }}
						<div class="field">
							<label for="body">Note</label>
							<div class="control">
								<input class="input" type="text" name="note" required>
							</div>
						</div>
						<div class="field">
							<label for="progress">Progress</label>
							<div class="control">
								<input class="input" type="number" min="0" max="100" name="progress" required>
							</div>
						</div>
						<div class="field">
							<button type="submit" class="button">Update Progress</button>
						</div>
					</form>		
				</div>
				<div class="column">
					<canvas id="timeline"></canvas>

					<h2>Progress:</h2>
					<!-- <div id="progress"></div> -->
					<progress class="progress is-warning is-large" data-label="{{$task->progress}}% Complete" value="{{$task->progress}}" max="100">
						
					</progress>
					<p class="pull-right">100</p>
					<p class="pull-left">0</p>	
					
					<br>
					<hr>
					<h2>Timeline:</h2>
					<?php 
						$date1 = new DateTime($task->target);
						$date2 = new DateTime($task->created_at);
						$currentDate = NOW();
						$interval = $date2->diff($currentDate);
						$interva2 = $date1->diff($date2);
						
					?>

					<div>
						<progress class="progress is-warning is-large"  value="{{$interval->days}}" max="{{$interva2->days}}">
						</progress>
						<div>
							<p class="pull-right">{{$task->target}}</p>
							<p class="pull-left">{{$task->created_at}}</p>
							<br>
						</div>
					</div>
					<div class="content">
						<h1>{{$task->project->name}} : {{$task->name}}</h1>
						<table class="table">
							<thead>
								<tr>
									<th>Notes</th>
									<th>Progress</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($task->progressMetric as $note)
								<tr>
									<td>{{ $note->note }}</td>
									<td>{{ $note->progress }}</td>
								</tr>
								@endforeach	
							</tbody>
						</table>
					</div>	
				</div>
			</div>
		</div>
	</section>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js" integrity="sha256-N4u5BjTLNwmGul6RgLoESPNqDFVUibVuOYhP4gJgrew=" crossorigin="anonymous"></script>

	<script type="text/javascript">
		indicatorData = {
			datasets: [{
				data: [{{$task->progress}}, {{100 - $task->progress}}],
				backgroundColor: [
					'#23d160',
					'#ff3860'
				]
			}],
			labels: [
				'Complete',
				'Incomplete'
			],
		}
		var x = [];
		@foreach ($task->progressMetric as $metric)
		x.push({ x: new Date('{{$metric->created_at}}'), y: {{$metric->progress}} })
		@endforeach

		//DeadlineDate
		x.push({ x: new Date('{{$task->target}}'), y: {{100}} })

		var timelineData = {
			datasets: [{
				data: x,
				fill: false,
				label: 'Progress',
				borderColor: '#23d160'
			}],

		}
		indicator = document.getElementById('indicator');
		timeline = document.getElementById('timeline');
		var dougnut = new Chart(indicator, {
			type: 'doughnut',
			data: indicatorData
		});
		var line = new Chart(timeline, {
			type: 'line',
			data: timelineData,
			options: {
		        scales: {
		            xAxes: [{
		                type: 'time',
		                time: {
		                	unit: 'day'
		                },
		                distribution: 'linear'
		            }],
		            yAxes: [{
		            	type: 'linear',
		            	ticks: {
				            beginAtZero: true,
				            max : 100,
				            min : 0
				       },
		            }]
		        }
		    }
		});


	</script>

	<style type="text/css">
		progress {
		  text-align: center;
		  height: 1.5em;
		  width: 100%;
		  -webkit-appearance: none;
		  border: none;
		  
		  /* Set the progressbar to relative */
		  position:relative;
		}
		progress:before {
		  content: attr(data-label);
		  font-size: 0.8em;
		  vertical-align: 0;
		  
		  /*Position text over the progress bar */
		  position:absolute;
		  left:0;
		  right:0;
		}
		progress::-webkit-progress-bar {
		  background-color: #c9c9c9;
		}
		progress::-webkit-progress-value {
		  background-color: #7cc4ff;
		}
		progress::-moz-progress-bar {
		  background-color: #7cc4ff;
		}
	</style>
@endsection