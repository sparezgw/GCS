<?php
/**
* 
*/
class Users extends Controller {

	protected $user;
	
	function __construct() {
		parent::__construct();
		$this->user = new DB\SQL\Mapper($this->db,'Users');
	}

	function beforeroute($f3) {}

	function login($f3) {

		if ($f3->exists('POST.login')) {

			$u = $this->user;
			$pwd = $f3->get('POST.password');
			$pwd = crypt($pwd,'gcs@2013');

			$u->load(array('uname=?', $f3->get('POST.username')));

			if(empty($u->uID)) //username does not exist.

				$msg = "用户名不存在。";

			else if ($pwd != $u->passwd) //password is wrong.

				$msg = "密码输入有误。";

			else { //both username and password are right, and goto main page.

				$f3->set('SESSION.UUID', $u->uID);
				$f3->set('SESSION.PID', $u->pID);
				if ($u->tID) $f3->set('SESSION.TEAM', $u->tID);
				$f3->reroute('/home');
			}

			//if sth. wrong with the form, then print the message.
			$f3->set('msg', $msg);
			$f3->set('pageTitle', '请登录');
			$f3->set('pageContent', 'users/_login.html');

		} else {
			
			//just view the login form.
			$f3->set('url', '/user/login');
			$f3->set('pageTitle', '请登录');
			$f3->set('pageContent', 'users/_login.html');

		}
		
	}

	function logout($f3) {
			
		$f3->clear('SESSION');
		$f3->reroute('/user/login');
	}

	function reg($f3) {
			
		if ($f3->exists('POST.reg')) {
			$u = $this->user;
			$email = $f3->get('POST.username');
			$name = $f3->get('POST.name');
			$u->load(array('uname=?', $email));
			if ($f3->get('POST.password') != $f3->get('POST.confirm'))
				$msg = "密码输入两次不一样。";
			elseif (!empty($this->user->uID))
				$msg = "用户名已存在。";
			else {
				$u->uname = $email;
				$pwd = $f3->get('POST.password');
				$u->passwd = crypt($pwd,'gcs@2013');
				$u->pID = '000000';
				$u->insert();

				$u->load(array('uname=?', $email));
				$uid = $u->uID;

				$p = $this->db->exec(
					array(
						'INSERT INTO People (uID,name,email) VALUES (:uid,:name,:email)',
						'SELECT pID FROM People WHERE uID=:uid'
					),
					array(
						array(':uid'=>(int)$uid, ':name'=>$name, ':email'=>$email),
						array(':uid'=>(int)$uid)
					)
				);
				$u->load(array('pID=?', '000000'));
				$u->pID = $p[0]['pID'];
				$u->update();

				$f3->reroute('/');
				
			}
			$f3->set('msg', $msg);
		}
		$f3->set('pageTitle', '用户注册');
		$f3->set('pageContent', 'users/_reg.html');
	}
}
