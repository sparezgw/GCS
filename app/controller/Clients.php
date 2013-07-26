<?php
/**
* 
*/
class Clients extends Controller
{
	protected
		$people;
	
	function __construct()
	{
		parent::__construct();
		$this->people = new DB\SQL\Mapper($this->db,'People');
	}

	function all($f3) {

		$f3->set('pageTitle', 'Client List');
		$f3->set('pageContent', 'clients/_list.html');
		$f3->set('people',
			$this->db->exec('SELECT * FROM People WHERE uID=?', $f3->get('SESSION.UUID'))
		);

	}

	function show($f3,$args) {
		$p = $this->people;
		$pid = empty($args['pid'])?'':$args['pid'];
		$p->load(array('pID=?',$pid));
		if ($p->dry()) {
			$f3->error(404);
			die;
		} else {
			$p->copyto('person');
			$fromArray = array('缘故','转介绍','随缘开发','陌生名单');
			$f = $f3->get('person.from');
			$f = empty($f)?'':$fromArray[$f];
			$f3->set('person.from', $f);
		}
		$f3->set('pageTitle', 'Client Details');
		$f3->set('pageContent', 'clients/_show.html');
	}

	function add($f3) {

		if ($_POST != array()) {
			$p = $this->people;
			$p->uID = $f3->get('SESSION.UUID');
			// $p->parentID = 0;
			$p->copyFrom('POST');
			$p->save();

			// $f3->set('pageTitle', 'xxx');
			// $f3->set('pageContent', 'test.html');
			$f3->reroute('/client/list');

		} else {
			
			// just view the login form.
			$f3->set('pageTitle', 'Add New Client');
			$f3->set('pageContent', 'clients/_add.html');

		}
	}


	

}

