<?php
/**
* 
*/
class Teams extends Controller {
	
	function __construct() {
		parent::__construct();
		$this->team = new DB\SQL\Mapper($this->db,'Teams');
	}

	function beforeroute($f3) {
		parent::__construct();
		if (!$f3->exists('SESSION.TEAM'))
			$f3->reroute('/home');
	}

	protected function info($f3) {
		$t = $this->team;
		$uid = $f3->get('SESSION.UUID');
		$tid = $f3->get('SESSION.TEAM');
		$sql = 'SELECT u.uID, u.uname, p.name From Users AS u LEFT JOIN People AS p ON u.pID = p.pID';
		if ($tid && $tid != 255) { // Super Administrator
			$t->load(array('tID=?', $tid));
			if($t->dry()) {
				$f3->error(404);
				die;
			} else $t->copyTo('team');
			// $uids = substr($team_uids, 1, strlen($team_uids) - 2);
			$uids = implode(",", json_decode($t->members));
			if (!strlen(trim($uids))) {
				$uids = $uid;
				$sql .= ' WHERE u.uID IN ('.$uids.')';
			} else {
				$uids = $uid.','.trim($uids);
				$sql .= ' WHERE u.uID IN ('.$uids.')';
				$sql .= ' ORDER BY instr("'.$uids.',", u.uID+",")';
			}
		}
		return $this->db->exec($sql);
	}

	function activity($f3) {
		$users = $this->info($f3);
		$api = new API;
		$members = array();
		foreach ($users as $user) {
			$arr = array('activity' => $api->activity($f3, $user['uID']));
			$result = array_merge($user, $arr);
			array_push($members, $result);
		}
		$f3->set('members', $members);
		$f3->set('pageTitle', '团队活动量列表');
		$f3->set('pageContent', 'teams/_activity.html');
	}

	function member($f3) {
		if ($f3->exists('POST.add')) {
			$new = trim($f3->get('POST.uname'));
			if ($new) {
				$u = new DB\SQL\Mapper($this->db,'Users');
				$u->load(array('uname=?', $new));
				if (!$u->dry()) {
					$newID = $u->uID; // get uID of the new member
					if ($newID != $f3->get('SESSION.UUID')) {
						$t = $this->team;
						$tid = $f3->get('SESSION.TEAM');
						$t->load(array('tID=?', $tid));// load the original members list
						$uids = json_decode($t->members);
						array_push($uids, $newID);// push the new into list
						$t->members = json_encode($uids);
						$t->save();
					}
				}
			}
		}
		$members = $this->info($f3);
		$f3->set('members', $members);
		$f3->set('url', '/team/member');
		$f3->set('pageTitle', '团队人员名单');
		$f3->set('pageContent', 'teams/_member.html');
	}

	function remove($f3, $args) {
		$t = $this->team;
		$uid = (int)trim($args['uid']);
		$tid = $f3->get('SESSION.TEAM');
		if ($tid && $tid != 255) {
			$t->load(array('tID=?', $tid));
			if($t->dry()) {
				$f3->error(404);
				die;
			}
			$uids = json_decode($t->members);
			$key = array_search($uid, $uids);
			if ($key !== FALSE) { // found the position of uID
				unset($uids[$key]);
			}
			$t->members = '['.implode(",", $uids).']';
			$t->save();
		}
		$f3->reroute('/team/member');
	}
}
?>