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
		$pageCount = (int) ceil($this->totalCount / $this->perPage);
		$lastPage = 1 + max(0, $pageCount - 1);

		if ($this->totalCount / $this->perPage < 2)
		{
			$steps = array($this->currentPage);
		}
		else
		{
			$arr = range(max(1, $this->currentPage - 3), min($lastPage, $this->currentPage + 3));
			$this->totalCount = 4;
			$quotient = ($pageCount - 1) / $this->totalCount;

			for ($i = 0; $i <= $this->totalCount; $i++)
			{
				$arr[] = round($quotient * $i) + 1;
			}
			sort($arr);
			$steps = array_values(array_unique($arr));
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