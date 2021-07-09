
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
				@if( strpos((string)$step, 'space') !== FALSE )
					<li class="page-item disabled">
						<span class="page-link">…</span>
					</li>
				@elseif( $step == $currentPage )
					<li class="page-item active">
						<span class="page-link">{{$step}}</span>
					</li>
				@else
					<?php $params = array_merge($routeParams, [$pageParam => $step]); ?>
					<li class="page-item">
						<a href="{{route($routeName, $params)}}" class="page-link">{{$step}}</a>
					</li>
				@endif
			@endforeach

			@if( $currentPage === $lastPage )
				<li class="page-item disabled"></li>
				<span class="page-link">&rsaquo;</span>
			@else
				<?php $params = array_merge($routeParams, [$pageParam => min($currentPage + 1, $lastPage)]); ?>
				<li class="page-item">
					<a class="page-link" href="{{route($routeName, $params)}}">&rsaquo;</a>
				</li>
			@endif
		</ul>
	</nav>
@endif
