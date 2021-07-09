<?php

namespace Camohub\Paginator;


use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;


class Paginator
{

	/** @var  LengthAwarePaginator $laraPaginator */
	public $laraPaginator;

	/** @var  Request $request */
	public $request;

	/** @var  Collection  $model */
	public $model;

	/** @var  String $routeName */
	public $routeName;

	/** @var  array $routeName */
	public $routeParams;

	/** @var  string $routeName */
	public $pageParam;

	/** @var  int $perPage */
	public $perPage;

	/** @var  int */
	public $totalCount;

	/** @var  int */
	public $skip;

	/** @var  Collection */
	public $items;


	/** @var int  */
	public $sideItemsCount = 3;


	public function __construct(
		Request $request,
		$model,
		$routeName,
		$routeParams = [],
		$perPage = 2,
		$pageParam = 'page'
	) {
		$this->request = $request;
		$this->model = $model;
		$this->routeName = $routeName;
		$this->routeParams = $routeParams;
		$this->pageParam = $pageParam;
		$this->perPage = $perPage;

		$this->currentPage = $request->route()->parameter($pageParam) ?: ($request->query($pageParam) ?: 1);

		$this->totalCount = $this->model->count();
		$this->skip = $this->perPage * $this->currentPage - $this->perPage;
		$this->items = $this->model->skip($this->skip)->take($this->perPage)->get();
	}



	public function render()
	{
		$pageCount = $lastPage = (int) ceil($this->totalCount / $this->perPage);

		if ($pageCount < 2)
		{
			$steps = [1];
		}
		else
		{
			$min = max(1, $this->currentPage - $this->sideItemsCount);
			$max = min($lastPage, $this->currentPage + $this->sideItemsCount);
			$currentWindow = range($min, $max);
			if( $min > 3 ) array_unshift($currentWindow, 'space1');
			if( $max < $pageCount - 2 ) array_push($currentWindow, 'space2');  // Has to be unique because of array_unique()

			$steps = [1, 2];
			$steps = array_merge($steps, $currentWindow);
			$steps = array_merge($steps, [$pageCount - 1, $pageCount]);
			$steps = array_unique($steps);
		}

		return view('camohubPaginator::base', [
			'steps' => $steps,
			'pageCount' => $pageCount,
			'currentPage' => $this->currentPage,
			'lastPage' => $lastPage,
			'routeName' => $this->routeName,
			'routeParams' => $this->routeParams,
			'pageParam' => $this->pageParam,
		]);
	}


	public function getItems()
	{
		return $this->items;
	}

}