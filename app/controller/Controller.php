<?php
/**
* 
*/
class Controller {

	protected
		$db;
	
	function __construct() {
		$f3=Base::instance();
		// Connect to the database
		$this->db = new DB\SQL($f3->get('db'), $f3->get('db_user'), $f3->get('db_pwd'));
	}

	function afterroute() {
		echo Template::instance()->render('layout.html');
	}
	
	function render($page) {
	    	
		$class = strtolower(strstr(get_called_class(), 'Controller', true));
		$page = 'app/view/'.$class.'/_'.$page.'.html';
		
		echo View::instance()->render($page);
	}
}
