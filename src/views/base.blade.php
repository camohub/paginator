
@if( $pageCount > 1)
	<div class="paginator">
		@if( $currentPage === 1 )
			<span class="button">«</span>
		@else
			<?php $params = array_merge($routeParams, [$pageParam => $currentPage - 1]); ?>
			<a href="{{route($routeName, $params)}}">«</a>
		@endif

		@foreach( $steps as $step )
			@if( $step == $currentPage )
				<span class="current">{{$step}}</span>
			@else
				<?php $params = array_merge($routeParams, [$pageParam => $step]); ?>
				<a href="{{route($routeName, $params)}}">{{$step}}</a>
			@endif
			@if( $loop->iteration > $step )
				<span>…</span>
			@endif
		@endforeach

		@if( $currentPage === $lastPage )
			<span class="button">»</span>
		@else
			<?php $params = array_merge($routeParams, [$pageParam => $step]); ?>
			<a href="{{route($routeName, $params)}}">»</a>
		@endif
	</div>
@endif
