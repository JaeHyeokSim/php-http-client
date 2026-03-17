<?php

class Request {

	public $method;
	public $url;
	public $headers = [];
	public $body;

	public function __construct($method, $url, $body = null, $headers = []) {

		$this->method = $method;
		$this->url = $url;
		$this->body = $body;
		$this->headers = $headers;
	}
}