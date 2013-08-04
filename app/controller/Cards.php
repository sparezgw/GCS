<?php
/**
* 
*/
class Cards extends Controller {
	
	protected $people;
	protected $card;
	
	function __construct()
	{
		parent::__construct();
		$this->people = new DB\SQL\Mapper($this->db,'People');
		$this->card = new DB\SQL\Mapper($this->db,'Cards');
	}

	function edit($f3, $args) {
		$c = $this->card;
		$p = $this->people;
		$pid = (int)(empty($args['pid']))?'':$args['pid'];
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
				$c->create_time = date("Y-m-d H:i:s");
				$c->update_time = NULL;
			} else {
				$c->update_time = date("Y-m-d H:i:s");
			}
			$newFamily = array_map ('intval', $f3->split($newFamily));
			$c->family = json_encode($newFamily);
			$c->memo = $f3->get('POST.memo');
			$c->next_time = ($f3->get('POST.next')=='')?NULL:$f3->concat('POST.next', ' '.date("H:i:s"));
			$c->save();

			$f3->reroute('/card/p/'.$pid);

		} else {
			
			$p->load(array('pID=?', $pid));
			$p->copyto('person'); // show the main client infomation
			$f3->set('people', // the list of popup menu
				$p->find('uID='.$uid.' and parentID=0 and pID<>'.$pid, array('order'=>'pID'))
			);

			$c->load(array('pID=?', $pid));
			if ($c->dry()) { // New card 
				$f3->set('action', 'insert');
				$f3->set('pageTitle', 'New Card');
			} else { // View&Edit card
				$c->copyto('card');
				$f3->set('action', 'update');
				$f3->set('pageTitle', 'Card '.$pid);
			}
			$f3->set('url', '/card/p/'.$pid);
			$f3->set('pageContent', 'cards/_edit.html');
		}
	}


}
