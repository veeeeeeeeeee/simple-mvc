<?php

//require_once('init.php');

//__init__();
//$config = $GLOBALS['config'];

//$db = new Database($config);
//$r = $db->query('SELECT * FROM test;');
//while ($a = mysql_fetch_array($r)) {
//	print_r($a);
//}

//require PATH_MODEL . 'Engineer.php';
//require PATH_MODEL . 'PersonEntity.php';

//$p = new PersonEntity("Tester", 55.00, 177.02);

//$p->load_by_id(9);
//echo $p->get_lastname();
//echo $p->get_weight();
//echo $p->get_height();
//$p->set_lastname("Jobs");
//$p->set_weight(47.55);
//$p->set_height(180);
//echo $p->save();

//echo $p->delete();

//echo "<pre>";
//print_r($p->all());
//echo "</pre>";


require_once('vendors/core/App.class.php');
App::start();




?>
