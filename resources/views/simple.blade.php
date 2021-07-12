
@if( $pageCount > 1)
	<nav>
		<ul class="pagination">

			<?php $params = array_merge($routeParams, [$pageParam => $steps[0] > 1 ? $steps[0] : NULL]); ?>
				@if( $currentPage == $steps[0] )
					<li class="page-item disabled">
						<span class="page-link">Prev</span>
					</li>
				@else
					<li class="page-item">
						<a href="{{route($routeName, $params)}}" class="page-link">Prev</a>
					</li>
				@endif
			</li>

			<?php $params = array_merge($routeParams, [$pageParam => $steps[1]]); ?>
			<li class="page-item disabled">
				@if( $currentPage == $steps[1] )
					<li class="page-item disabled">
						<span class="page-link">Next</span>
					</li>
				@else
					<li class="page-item">
						<a href="{{route($routeName, $params)}}" class="page-link">Next</a>
					</li>
				@endif
			</li>

		</ul>
	</nav>
@endif