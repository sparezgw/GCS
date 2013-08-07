<?php
/**
* 
*/
class Notes extends Controller {
	
	protected $note;
	
	function __construct() {
		parent::__construct();
		$this->note = new DB\SQL\Mapper($this->db,'Notes');
	}

	function show($f3, $args) {
		$n = $this->note;
		$uid = $f3->get('SESSION.UUID');
		$pid = (int)trim($args['pid']);
		$f3->set('modes', array('电话','面谈','短信','网络'));
		if ($f3->exists('POST.add')) {

			$n->pID = $pid;
			$n->uID = $uid;
			$n->copyFrom('POST');
			$n->save();

			$f3->reroute('/note/p/'.$pid);
		} else {
			$f3->set('notes', 
				$n->find('uID='.$uid.' and pID='.$pid, array('order'=>'time'))
			);
		}
			
		$f3->set('pageTitle', 'Note '.$pid);
		$f3->set('pageContent', 'notes/_show.html');
	}

	function del($f3, $args) {

		$n = $this->note;	
		$nid = (int)trim($args['nid']);
		$p->erase(array('nID=?', $nid));

		$f3->reroute('/card/list');
	}
}
