<?php
/**
* 
*/
class Home extends Controller {
	
	function __construct() {
		$f3=Base::instance();
	}

	function main($f3) {

	    if ($f3->get('SESSION.UUID') != "") {

			$f3->reroute('/home');

		} else {

			$f3->reroute('/user/login');

		}
	}

	function get($f3) {
		$uid = $f3->get('SESSION.UUID');
		$pid = $f3->get('SESSION.PID');
		$db = new DB\SQL($f3->get('db'), $f3->get('db_user'), $f3->get('db_pwd'));
		$p = new DB\SQL\Mapper($db,'People');
		$filter = 'uID='.$uid.' and pID<>'.$pid;
		$f3->set('pNum', $p->count($filter));
		$c = new DB\SQL\Mapper($db,'Cards');
		$f3->set('cNum', $c->count($filter));

	    $f3->set('url', '/home');
		$f3->set('pageTitle', '首页');
		$f3->set('pageContent', 'home/index.html');
	}

	function help($f3) {
	    	
		$f3->set('pageTitle', '帮助');
		$f3->set('pageContent', 'home/_help.html');
	}

	function un($f3) {
	    	
		$f3->set('pageTitle', '未完成');
		$f3->set('pageContent', 'home/un.html');
	}
}

