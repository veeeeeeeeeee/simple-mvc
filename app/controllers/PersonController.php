<?php

require_once PATH_MODEL . 'PersonEntity.php';
require_once PATH_VIEW . 'PersonView.php';

class PersonController extends BaseController {
	/**
	 * show all persons
	 *
	 * @param
	 * @return null
	 */
	public function index() {
		//echo "calling index";

		// create PersonEntity
		$p = new PersonEntity("", 0, 0);
		// query all
		$persons = $p->all();
		//echo "<pre>";
		//print_r($persons);
		//echo "</pre>";

		$v = new PersonView();
		$v->set('testkey', 'testval');
		$v->set('persons', $persons);
		$v->render('index.php');
		// render view displaying table (calling display() here?), include links to edit, view?, delete -- will be handled in template
	}

	/**
	 * add new person to the db - view
	 *
	 * @param
	 * @return render the template
	 */
	public function add() {
		//echo "calling add";
		// render view with bunch of input fields, calling add_save()

		$dest = APP_HOME . '/index.php?controller=Person&action=add';

		$v = new PersonView();
		$v->set('posturl', $dest);
		$v->render('add.php');
	}

	/**
	 * add new person to the db - db access via entity
	 *
	 * @param
	 * @return reroute to index
	 */
	public function add_save() {
		echo "calling add save";
		// get data from post
		$post = [
			'lastname' => $_POST['lastname'],
			'weight' => $_POST['weight'],
			'height' => $_POST['height']
		];

		// create PersonEntity, use sets
		$p = new PersonEntity($post['lastname'], $post['weight'], $post['height']);
		//echo $p->display(true);

		// call save
		$p->save();
		// redirect to index
		$this->redirect(APP_HOME . '/index.php?controller=Person&action=index');
	}

	/**
	 * edit existing person in the db - view
	 *
	 * @param
	 * @return render the template
	 */
	public function edit() {
		//echo "calling edit";
		// get id
		// create PersonEntity, load_by_id
		// render view with bunch of input fields, populate with PersonEntity data
	}

	/**
	 * edit existing person in the db - db access via entity
	 *
	 * @param
	 * @return reroute to index
	 */
	public function edit_save() {
		//echo "calling edit save";
		// get id, get post data
		// create PersonEntity, load_by_id
		// call save
		// redirect to index
	}

	/**
	 * delete person in the db - db access
	 *
	 * @param
	 * @return reroute to index
	 */
	public function delete() {
		//echo "calling delete";
		// get id, create PersonEntity, load_by_id
		// call delete
		// redirect to index
	}
}

?>
