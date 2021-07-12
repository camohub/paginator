
@if( $pageCount > 1)
	<nav>
		<ul class="pagination">

			<?php $params = array_merge($routeParams, [$pageParam => $steps[0] > 1 ? $steps[0] : NULL]); ?>
			<li class="page-item">
				@if( $currentPage == $step[0] )
					<span class="page-link disabled">Prev</span>
				@else
					<a href="{{route($routeName, $params)}}" class="page-link">Prev</a>
				@endif
			</li>

			<?php $params = array_merge($routeParams, [$pageParam => $steps[1]]); ?>
			<li class="page-item">
				@if( $currentPage == $step[1] )
					<span class="page-link disabled">Next</span>
				@else
					<a href="{{route($routeName, $params)}}" class="page-link">Next</a>
				@endif
			</li>

		</ul>
	</nav>
@endif
