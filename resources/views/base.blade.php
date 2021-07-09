
@if( $pageCount > 1)
<nav>
	<ul class="pagination">
		@if( $currentPage === 1 )
			<li class="page-item disabled">
				<span class="page-link">&lsaquo;</span>
			</li>
		@else
			<?php $params = array_merge($routeParams, [$pageParam => max(1, $currentPage - 1)]); ?>
			<li class="page-item">
				<a href="{{route($routeName, $params)}}" class="page-link">&lsaquo;</a>
			</li>
		@endif

		@foreach( $steps as $step )
			@if( $step == $currentPage )
				<li class="page-item active">
					<span class="page-link">{{$step}}</span>
				</li>
			@else
				<?php $params = array_merge($routeParams, [$pageParam => $step]); ?>
				<li class="page-item">
					<a href="{{route($routeName, $params)}}" class="page-link">{{$step}}</a>
				</li>
			@endif
			@if( $loop->iteration > $step )
				<li class="page-item disabled">
					<span class="page-link">…</span>
				</li>
			@endif
		@endforeach

		@if( $currentPage === $lastPage )
			<li class="page-item disabled"></li>
			<span class="page-link">&rsaquo;</span>
		@else
			<?php $params = array_merge($routeParams, [$pageParam => $step]); ?>
			<li class="page-item">
				<a class="page-link" href="{{route($routeName, $params)}}">&rsaquo;</a>
			</li>
		@endif
	</ul>
</nav>
@endif
