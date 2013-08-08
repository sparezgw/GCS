<?php
/**
* 
*/
class Home extends Controller {
	
	function __construct() {
		parent::__construct(false);
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
		$f3->set('pageTitle', 'Home');
		$f3->set('pageContent', 'home/index.html');
	}

	function un($f3) {
	    	
		$f3->set('pageTitle', '未完成');
		$f3->set('pageContent', 'home/un.html');
	}
}

