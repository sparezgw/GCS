<?php
/**
* 
*/
class Cards extends Controller {
	
	protected $people, $card;
	
	function __construct() {
		parent::__construct();
		$this->people = new DB\SQL\Mapper($this->db,'People');
		$this->card = new DB\SQL\Mapper($this->db,'Cards');
	}

	function edit($f3, $args) {
		$c = $this->card;
		$p = $this->people;
		$pid = (int)trim($args['pid']);
		$uid = (int)$f3->get('SESSION.UUID');
		$family = $p->find(array('parentID=?', $pid));
		$f3->set('family', $family);

		if ($f3->exists('POST.edit')) {
			// restore the parentID of original family
			if (!empty($family)) {
				$pids = array();
				foreach ($family as $obj)
					array_push($pids,$obj->pID);
				$pids = implode(",", $pids);
				$this->db->exec('UPDATE People SET parentID = 0 WHERE pID IN ('.$pids.')');

			}

			// set the new family parentID
			$newFamily = $f3->get('POST.family');
			if (!empty($newFamily)) {
				$this->db->exec('UPDATE People SET parentID = '.$pid.' WHERE pID IN ('.$newFamily.')');
			}

			// save the form
			$c->load(array('pID=?', $pid));
			if ($c->dry()) { // New card
				$c->pID = $pid;
				$c->uID = $uid;
				$c->create_time = date($f3->get('time_format'));
				$c->update_time = NULL;
			} else {
				$c->update_time = date($f3->get('time_format'));
			}
			$newFamily = array_map('intval', $f3->split($newFamily));
			$c->family = json_encode($newFamily);
			$c->memo = $f3->get('POST.memo');
			$c->next_time = ($f3->get('POST.next')=='')?NULL:$f3->concat('POST.next', ' '.date("H:i:s"));
			$c->save();

			$f3->reroute('/card/'.$pid);

		} else {
			$p->load(array('pID=? and uID=? and parentID=0', $pid, $uid));
			if ($p->dry()) $f3->reroute('/card/list');
			else $p->copyto('person'); // show the main client infomation
			$upid = $f3->get('SESSION.PID');
			$pids = array($pid,$upid);
			$card_pids = $c->select('pID', array('uID=?', $uid));
			foreach ($card_pids as $obj)
				array_push($pids,$obj->pID);
			$pids = implode(",", $pids);
			$f3->set('people', // the list of popup menu
				$p->find('uID='.$uid.' and parentID=0 and pID NOT IN ('.$pids.')', array('order'=>'pID'))
			);

			$c->load(array('pID=?', $pid));
			if ($c->dry()) { // New card 
				$f3->set('action', 'insert');
				$f3->set('pageTitle', '新建卡片');
			} else { // View&Edit card
				$c->copyto('card');
				$f3->set('action', 'update');
				$f3->set('pageTitle', '卡片资料');
			}

			$f3->set('url', '/card/'.$pid);
			$f3->set('pageContent', 'cards/_edit.html');
		}
	}

	function all($f3, $args) {
		$type = (empty($args['type']))?'0':$args['type'];
		$sql_uid = ' and c.uID='.$f3->get('SESSION.UUID');
		$sql = 'SELECT c.*, p.name, p.mobile FROM Cards AS c, People AS p WHERE c.pID=p.pID and p.parentID=0'.$sql_uid;
		switch ($type) {
			case '1':
				$sql = $sql.' and c.status=0 and next_time>CURDATE() ORDER BY next_time';
				break;

			case '2':
				$sql = $sql.' and c.status=0 and next_time<CURDATE() ORDER BY next_time DESC';
				break;

			case '3':
				$sql = $sql.' and c.status=1 ORDER BY update_time DESC';
				break;

			case '0':
			default:
				$sql = $sql.' and c.status=0 ORDER BY create_time';
				break;
		}
		
		$url = ($type!='0')?'/card/list/'.$type:'/card/list';
		$f3->set('cards',$this->db->exec($sql));
		$f3->set('url', $url);
		$f3->set('pageTitle', '卡片列表');
		$f3->set('pageContent', 'cards/_list.html');
	}

	function deal($f3, $args) {
		$c = $this->card;
		$pid = (int)trim($args['pid']);
		$c->load(array('pID=?', $pid));
		$c->status = ($c->status)?0:1;
		$c->save();
		$f3->reroute('/card/list');
	}
}
