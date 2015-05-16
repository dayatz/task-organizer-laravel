@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Your boards</div>

				<div class="panel-body board-container">
					@foreach ($boards as $board)
					    <p><a href="/board/{{ $board->id }}">{{ $board->name }}</a></p>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
