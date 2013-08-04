<?php
/**
* 
*/
class API extends Controller {

	protected $user;
	protected $people;
	protected $card;

	function __construct()
	{
		parent::__construct();
		$this->user = new DB\SQL\Mapper($this->db,'Users');
		$this->people = new DB\SQL\Mapper($this->db,'People');
		$this->card = new DB\SQL\Mapper($this->db,'Cards');
	}

	function afterroute() {}

	function addPerson($f3) {
	    	
		$p = new People;
		$p->add($f3);
		$parentID = $f3->get('POST.parentID');
		$p = $this->people;
		$p->load(array('parentID=?',$parentID), array('order'=>'pID DESC'));
		if ($p->gender!=NULL) $p->gender = ($p->gender)?'男':'女';
		$per = array("id"=>$p->pID,"name"=>$p->name,"info"=>$p->gender.", ".$p->birthday.", ".$p->mobile);
		echo json_encode($per);
	}

}