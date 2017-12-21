<?php

require_once PATH_MODEL . 'PersonEntity.php';
require_once PATH_VIEW . 'PersonView.php';

class PersonController extends BaseController {
	protected $baseurl;
	public function __construct() {
		$this->baseurl = APP_HOME . '/index.php?controller=Person&action=';
	}
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
		$message = '';
		if (!empty($_SESSION['message'])) {
			$message = $_SESSION['message'];
		}
		$v->set('message', $message);
		
		$v->set('baseurl', $this->baseurl);
		$_SESSION['message'] = '';

		$v->render('index.php');
		// render view displaying table (calling display() here?), include links to edit, view?, delete -- will be handled in template
	}

	/**
	 * display a person
	 *
	 * @param
	 * @return
	 */
	public function view() {
		if (!isset($_GET['id'])) {
			$this->redirect(APP_HOME . '/index.php?controller=Person&action=index');
		}
		else {
			$row_id = $_GET['id'];
			$p = new PersonEntity("", 0, 0);
			$p->load_by_id($row_id);

			$content = $p->display(true);
			$v = new PersonView();
			$v->set('content', $content);
			$v->set('baseurl', $this->baseurl);
			$v->render('view.php');
		}
	}

	/**
	 * add new person to the db - view
	 *
	 * @param
	 * @return render the template
	 */
	public function add() {
		$_SESSION['message'] = '';
		//echo "calling add";
		// render view with bunch of input fields, calling add_save()
		$dest = APP_HOME . '/index.php?controller=Person&action=add';

		$v = new PersonView();
		$v->set('posturl', $dest);
		$v->set('baseurl', $this->baseurl);
		$v->render('add.php');
	}

	/**
	 * add new person to the db - db access via entity
	 *
	 * @param
	 * @return reroute to index
	 */
	public function add_save() {
		//echo "calling add save";
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
		$_SESSION['message'] = "Successfully added.";
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
		$_SESSION['message'] = '';
		//echo "calling edit";
		// get id
		if (!isset($_GET['id'])) {
			$this->redirect(APP_HOME . '/index.php?controller=Person&action=index');
		}
		else {
			$row_id = $_GET['id'];
			// create PersonEntity, load_by_id
			$p = new PersonEntity("", 0, 0);
			$p->load_by_id($row_id);

			$person = [
				'lastname' => $p->get_lastname(),
				'weight' => $p->get_weight(),
				'height' => $p->get_height()
			];
			//$this->pprint($p);
			//$this->pprint($person);
			// render view with bunch of input fields, populate with PersonEntity data
			$dest = APP_HOME . '/index.php?controller=Person&action=edit&id=' . $row_id;

			$v = new PersonView();
			$v->set('posturl', $dest);
			$v->set('person', $person);
			$v->set('baseurl', $this->baseurl);
			$v->render('edit.php');
		}
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
		//echo $_GET['id'];
		if (!isset($_GET['id'])) {
			$this->redirect(APP_HOME . '/index.php?controller=Person&action=index');
		}
		else {
			$row_id = $_GET['id'];
			$post = [
				'lastname' => $_POST['lastname'],
				'weight' => $_POST['weight'],
				'height' => $_POST['height']
			];
			// create PersonEntity, load_by_id
			$p = new PersonEntity("", 0, 0);
			$p->load_by_id($row_id);
			// update the posted values into the entity
			// TODO: fail check
			$p->set_lastname($post['lastname']);
			$p->set_weight($post['weight']);
			$p->set_height($post['height']);
			// call save
			//$this->pprint($p);
			$p->save();
			$_SESSION['message'] = 'Successfully edited.';

			// redirect to index
			$this->redirect(APP_HOME . '/index.php?controller=Person&action=index');
		}

	}

	/**
	 * delete person in the db - db access
	 *
	 * @param
	 * @return reroute to index
	 */
	public function delete() {
		//echo "calling delete";
		if (!isset($_GET['id'])) {
			$this->redirect(APP_HOME . '/index.php?controller=Person&action=index');
		}
		else {
			// get id, create PersonEntity, load_by_id
			$row_id = $_GET['id'];
			// create PersonEntity, load_by_id
			$p = new PersonEntity("", 0, 0);
			$p->load_by_id($row_id);
			//$this->pprint($p);
			// call delete
			$p->delete();
			$_SESSION['message'] = 'Successfully deleted.';
			// redirect to index
			$this->redirect(APP_HOME . '/index.php?controller=Person&action=index');
		}
	}

	function pprint($a) {
		echo "<pre>";
		print_r($a);
		echo "</pre>";
	}
}

?>
