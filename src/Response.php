<?php

class Response {

	public $status;
	public $headers;
	public $body;

	public function __construct($status, $headers, $body) {

		$this->status = $status;
		$this->headers = $headers;
		$this->body = $body;
	}
}