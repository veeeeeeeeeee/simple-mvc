<?php

class BaseController {
	// template class
	// potentially using Loader, Helper and Route
	// request and response - far out of scope
	public function __construct() {
	}

	public function render() {
	}

	public function redirect($url) {
		header("Location:$url");
	}
}

?>
