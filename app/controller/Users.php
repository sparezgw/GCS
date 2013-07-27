<?php
/**
* 
*/
class Users extends Controller {

	protected
		$user;
	
	function __construct() {

		parent::__construct();
		$this->user = new DB\SQL\Mapper($this->db,'Users');
	}

	function beforeroute($f3) {}

	function login($f3) {

		if ($f3->exists('POST.login')) {

			$this->user->load(array('uname=?', $f3->get('POST.username')));

		    if(empty($this->user->uID)) //username does not exist.

		    	$msg = "用户名不存在。";

		    else if ($f3->get('POST.password') != $this->user->passwd) //password is wrong.

		    	$msg = "密码输入有误。";

		    else { //both username and password are right, and goto main page.

				$f3->set('SESSION.UUID', $this->user->uID);
				$f3->set('SESSION.PID', $this->user->pID);
				$f3->reroute('/home');
			}

			//if sth. wrong with the form, then print the message.
			$f3->set('msg', $msg);
			$f3->set('pageTitle', 'Sign in');
			$f3->set('pageContent', 'users/_login.html');

		} else {
			
			//just view the login form.
			$f3->set('url', '/user/login');
			$f3->set('pageTitle', 'Sign in');
			$f3->set('pageContent', 'users/_login.html');

		}
		
	}

	function logout($f3) {
	    	
		$f3->clear('SESSION');
		$f3->reroute('/user/login');
	}

}
