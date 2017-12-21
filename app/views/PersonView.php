<?php

require_once PATH_LIB . 'BaseView.php';

class PersonView extends BaseView {
	public function __construct() {
		parent::__construct();
		$this->templates = 'person';
	}
}

?>
