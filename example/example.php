<?php

require_once "../src/Request.php";
require_once "../src/Response.php";
require_once "../src/MiddlewareStack.php";
require_once "../src/HttpClient.php";

$client = new HttpClient();

$client->addMiddleware(function($request, $next) {

	echo "Sending request to " . $request->url . "\n";

	return $next($request);
});

$request = new Request("GET", "https://api.github.com");

$response = $client->send($request);

echo $response->status;