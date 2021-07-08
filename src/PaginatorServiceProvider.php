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
		$this->app->bind('paginator', Paginator\Paginator::class);
	}
}