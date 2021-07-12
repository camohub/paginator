<?php

namespace Camohub\Paginator;


use Camohub\Paginator;
use Illuminate\Support\ServiceProvider;


/**
 * Class PasswordServiceProvider
 */
class PaginatorServiceProvider extends ServiceProvider
{
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('camohubPaginator', Paginator\Paginator::class);
		$this->app->bind('camohubSimplePaginator', Paginator\SimplePaginator::class);
		$this->loadViewsFrom( __DIR__ . '/../resources/views', 'camohubPaginator');
		$this->publishes([__DIR__ . '/../resources/views' => resource_path('views/vendor/camohubPaginator')]);
	}
}