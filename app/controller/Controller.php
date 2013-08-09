<?php
/**
* 
*/
class Controller {

	protected $db;
	
	function __construct() {
		$f3=Base::instance();
		$this->db = new DB\SQL($f3->get('db'), $f3->get('db_user'), $f3->get('db_pwd'));
	}

	function beforeroute($f3) {
		if ($f3->get('SESSION.UUID') == "") {
			$f3->reroute('/user/login');
		}
	}

	function afterroute() {
		echo Template::instance()->render('layout.html');
	}
	
}
