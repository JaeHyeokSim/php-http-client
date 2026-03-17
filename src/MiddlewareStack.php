<?php

class MiddlewareStack {

	private $stack = [];

	public function push(callable $middleware) {

		$this->stack[] = $middleware;
	}

	public function handle($request, callable $next) {

		$handler = array_reduce(
			array_reverse($this->stack),
			function ($next, $middleware) {
				return function ($request) use ($middleware, $next) {
					return $middleware($request, $next);
				};
			},
			$next
		);

		return $handler($request);
	}
}