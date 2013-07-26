<?php
/**
* 
*/
class Controller {

	protected
		$db;
	
	function __construct($w = true) {
		$f3=Base::instance();
		// Connect to the database
		if ($w) {
			$this->db = new DB\SQL($f3->get('db'), $f3->get('db_user'), $f3->get('db_pwd'));
		}
	}

	function beforeroute($f3) {	
		if ($f3->get('SESSION.UUID') == "") {
			$f3->reroute('/user/login');
		}

	// 	if ($f3->get('SESSION.lastseen')+$f3->get('expiry')*3600<time())
	// 		// Session has expired
	// 		$f3->reroute('/logout');
	// 	// Update session data
	// 	$f3->set('SESSION.lastseen',time());
	}

	function afterroute() {
		echo Template::instance()->render('layout.html');
	}
	
	/*function render($page) {
	    	
		$class = strtolower(strstr(get_called_class(), 'Controller', true));
		$page = 'app/view/'.$class.'/_'.$page.'.html';
		
		echo View::instance()->render($page);
	}*/
}
