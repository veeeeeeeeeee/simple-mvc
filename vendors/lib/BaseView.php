<?php

class BaseView {
	protected $templates; // template directory
	protected $packed_data = [];

	public function __construct() {
		$templates = null;
	}

	// allow controller to set data in view
	public function set($key, $val) {
		$this->packed_data[$key] = $val;
	}

	public function __get($key) {
		if (array_key_exists($key, $this->packed_data)) {
			return $this->packed_data[$key];
		}
	}

	public function render($template) {
		include PATH_TEMPLATE . $this->templates . DS . $template;
	}
}

?>
