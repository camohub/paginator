<?php

namespace Camohub;


use Illuminate\Support\Facades\Log;


class Paginator
{

	public function __construct()
	{
		Log::debug('*******************************************************');
		Log::debug(' This is Camohub\Paginator::__construct()');
		Log::debug('*******************************************************');
	}


	public function test()
	{
		Log::debug('*******************************************************');
		Log::debug(' This is Camohub\Paginator::test()');
		Log::debug('*******************************************************');
	}

}