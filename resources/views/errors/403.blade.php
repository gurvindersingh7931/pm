@extends('error_layout')
@section('content')
<div class="content has-text-centered" style="margin-top: 15%">
	<h1>{{ $exception->getMessage() }}</h1>
</div>
@endsection