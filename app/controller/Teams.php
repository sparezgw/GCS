<?php
/**
* 
*/
class Teams extends Controller {
	
	function __construct() {
		parent::__construct();
	}

	function view($f3) {
		$uid = $f3->get('SESSION.UUID');
		$api = new API;
		$act = $api->activity($f3, $uid);
		$f3->set('activity', $act);
		$f3->set('pageTitle', '活动量检视');
		$f3->set('pageContent', 'teams/_view.html');
	}

	function activity($f3) {
		//table-stroke
		$members = array();
		$team_uids = '[1,11,13,14]';
		$uids = substr($team_uids, 1, strlen($team_uids) - 2);
		// $uids = implode(",", json_decode($team_uids));
		$sql = 'SELECT u.uID, p.name From Users AS u LEFT JOIN People AS p ON u.pID = p.pID WHERE u.uID IN ('.$uids.')';
		$users = $this->db->exec($sql);
		$api = new API;
		foreach ($users as $user) {
			$arr = array('act' => $api->activity($f3, $user['uID']));
			$result = array_merge($user, $arr);
			array_push($members, $result);
		}
		$f3->set('members', $members);
		$f3->set('pageTitle', '团队活动量列表');
		$f3->set('pageContent', 'teams/_activity.html');
	}

	function member($f3) {
			
		# code...
	}
}
?>