<?php
/**
* 
*/
class Cards extends Controller {
	
	protected
		$cards;
	
	function __construct()
	{
		parent::__construct();
		$this->people = new DB\SQL\Mapper($this->db,'People');
		$this->card = new DB\SQL\Mapper($this->db,'Cards');
	}

	function show($f3, $args) {
	    	
		$p = $this->people;
		$c = $this->card;
		$pid = (empty($args['pid']))?'':$args['pid'];

		$p->load(array('pID=?', $pid));
		$p->copyto('person');

		$c->load(array('pID=?', $pid));
		if ($c->dry()) {
			$f3->set('family',
				$p->select('pID,name', array('parentID=?', $pid))
			);
			$f3->set('people',
				$p->select('*', 'uID='.(int)$f3->get('SESSION.UUID').' and parentID=0 and pID<>'.(int)$pid)
			);
			$f3->set('pageTitle', 'New Card');
			$f3->set('pageContent', 'cards/_show.html');
		} else {
			$f3->set('pageTitle', 'Card '.$pid);
			$f3->set('pageContent', 'cards/_show.html');
		}
	}
}
