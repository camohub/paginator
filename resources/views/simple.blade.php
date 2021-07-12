
@if( $pageCount > 1)
	<nav>
		<ul class="pagination">

			<?php $params = array_merge($routeParams, [$pageParam => $steps[0] > 1 ? $steps[0] : NULL]); ?>
			<li class="page-item disabled">
				@if( $currentPage == $steps[0] )
					<span class="page-link">Prev</span>
				@else
					<a href="{{route($routeName, $params)}}" class="page-link">Prev</a>
				@endif
			</li>

			<?php $params = array_merge($routeParams, [$pageParam => $steps[1]]); ?>
			<li class="page-item disabled">
				@if( $currentPage == $steps[1] )
					<span class="page-link">Next</span>
				@else
					<a href="{{route($routeName, $params)}}" class="page-link">Next</a>
				@endif
			</li>

		</ul>
	</nav>
@endif