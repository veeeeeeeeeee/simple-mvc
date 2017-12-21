<?php

class PersonController extends BaseController {
	public function index() {
		//echo "calling index";
		// create PersonEntity
		// query all
		// render view displaying table (calling display() here?), include links to edit, view?, delete
	}

	public function add() {
		//echo "calling add";
		// render view with bunch of input fields, calling add_save()
	}

	public function add_save() {
		//echo "calling add save";
		// get data from post
		// create PersonEntity, use sets
		// call save
		// redirect to index
	}

	public function edit() {
		//echo "calling edit";
		// get id
		// create PersonEntity, load_by_id
		// render view with bunch of input fields, populate with PersonEntity data
	}

	public function edit_save() {
		//echo "calling edit save";
		// get id, get post data
		// create PersonEntity, load_by_id
		// call save
		// redirect to index
	}

	public function delete() {
		//echo "calling delete";
		// get id, create PersonEntity, load_by_id
		// call delete
		// redirect to index
	}
}

?>
