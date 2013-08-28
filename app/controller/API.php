<?php
/**
* 
*/
class API extends Controller {

	protected $user, $people, $card;

	function __construct() {
		parent::__construct();
		$this->p = new DB\SQL\Mapper($this->db,'People');
		$this->c = new DB\SQL\Mapper($this->db,'Cards');
		$this->n = new DB\SQL\Mapper($this->db,'Notes');
	}

	function afterroute() {}

	function addPerson($f3) {
	    	
		$p = new People;
		$p->add($f3);
		$parentID = $f3->get('POST.parentID');
		$p = $this->p;
		$p->load(array('parentID=?',$parentID), array('order'=>'pID DESC'));
		if ($p->gender!=NULL) $p->gender = ($p->gender)?'男':'女';
		$per = array("id"=>$p->pID,"name"=>$p->name,"info"=>$p->gender.", ".$p->birthday.", ".$p->mobile);
		echo json_encode($per);
	}

	function usage($f3, $uid) {
		$filter = array('uID=?', $uid);
		return array('p'=>$this->p->count($filter)-1, 'c'=>$this->c->count($filter));
	}

	function activity($f3, $uid) {
		$act = array();
		$filter = 'uID = '.$uid.' AND date(create_time) = CURDATE()';
		$yes_filter = $filter.' - INTERVAL 1 DAY';
		$c = $this->c;
		$act['yesterday']['card'] = $c->count($yes_filter);
		$act['today']['card'] = $c->count($filter);
		$n = $this->n;
		$act['yesterday']['note'] = $n->count($yes_filter);
		$act['today']['note'] = $n->count($filter);
		$p = $this->p;
		$act['yesterday']['people'] = $p->count($yes_filter);
		$act['today']['people'] = $p->count($filter);

		return $act;
	}
}