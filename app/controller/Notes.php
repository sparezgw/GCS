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

		$pid = (int)(empty($args['pid']))?'':$args['pid'];
	    	
		$f3->set('pageTitle', 'Note '.$pid);
		$f3->set('pageContent', 'notes/_show.html');
	}
}
