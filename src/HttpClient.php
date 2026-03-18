<?php

class HttpClient
{

	private $middleware;

	public function __construct()
	{

		$this->middleware = new MiddlewareStack();
	}

	public function addMiddleware(callable $middleware)
	{

		$this->middleware->push($middleware);
	}

	public function send(Request $request)
	{

		$handler = function ($request) {

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $request->url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, [
				"User-Agent: Mozilla/5.0",
				"Accept: text/html"
			]);

			$body = curl_exec($ch);
			$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			curl_close($ch);

			return new Response($status, [], $body);
		};

		return $this->middleware->handle($request, $handler);
	}
}
