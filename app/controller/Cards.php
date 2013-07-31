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
		$c = $this->card;
		$pid = (int)(empty($args['pid']))?'':$args['pid'];
		$uid = (int)$f3->get('SESSION.UUID');

		if ($f3->exists('POST.cardAdd')) {
			$family = $f3->split($f3->get('POST.family'));
			$f3->set('POST.family', json_encode($family));
			
		} else {
			$p = $this->people;
			$p->load(array('pID=?', $pid));
			$p->copyto('person');

			$c->load(array('pID=?', $pid));
			if ($c->dry()) {
				$f3->set('family',
					$p->select('pID,name', array('parentID=?', $pid))
				);
				$f3->set('people',
					$p->select('*', 'uID='.$uid.' and parentID=0 and pID<>'.$pid)
				);
				$f3->set('pageTitle', 'New Card');
				$f3->set('pageContent', 'cards/_show.html');
			} else {
				$f3->set('pageTitle', 'Card '.$pid);
				$f3->set('pageContent', 'cards/_show.html');
			}
		}
	}
}
