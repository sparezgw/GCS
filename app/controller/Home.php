<?php
/**
* 
*/
class Home {
	
	function __construct() {
	
		$f3=Base::instance();
	}

	function afterroute() {
		echo Template::instance()->render('layout.html');
	}

	function main($f3) {

	    if ($f3->get('SESSION.UUID') != "") {

			$f3->reroute('/home');

		} else {

			$f3->reroute('/user/login');

		}
	}

	function get($f3) {
	    $f3->set('url', '/home');
		$f3->set('pageTitle', 'Index');
		$f3->set('pageContent', 'index.html');
	}


}

