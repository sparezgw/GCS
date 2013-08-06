<?php
/**
* 
*/
class People extends Controller
{
	protected $people;
	
	function __construct() {
		parent::__construct();
		$this->people = new DB\SQL\Mapper($this->db,'People');
	}

	function all($f3) {

		$f3->set('people',
			$this->db->exec(
				'SELECT son.*, IFNULL( father.pID, son.pID ) AS grp
				FROM People AS father
				RIGHT JOIN People AS son
				ON father.pID = son.parentID
				WHERE son.uID=?
				ORDER BY grp, parentID, pID',
				$f3->get('SESSION.UUID')
			)
		);
		$f3->set('url', '/client/list');
		$f3->set('pageTitle', 'Client List');
		$f3->set('pageContent', 'people/_list.html');
		
	}

	function show($f3,$args) {
		$p = $this->people;
		if (empty($args['pid'])) {
			$pid = $f3->get('SESSION.PID');
			$p->load(array('pID=?', $pid));
			$p->copyto('person');
			$f3->set('url', '/self/show');
			$f3->set('pageTitle', 'Info');
			$f3->set('pageContent', 'people/_info.html');
		} else {
			$pid = $args['pid'];
			$p->load(array('pID=?', $pid));
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
			$f3->set('url', '/client/'.$pid);
			$f3->set('pageTitle', 'Client Details');
			$f3->set('pageContent', 'people/_show.html');
		}
		
	}

	function add($f3) {

		if ($_POST != array()) {
			$p = $this->people;
			$p->uID = $f3->get('SESSION.UUID');
			$p->copyFrom('POST');
			if ($p->birthday=='') $p->birthday = NULL;
			$p->save();

			if ($f3->exists('POST.add')) {
				$f3->reroute('/client/list');
			}

		} else {
			
			// just view the login form.
			$f3->set('pageTitle', 'Add New Client');
			$f3->set('pageContent', 'people/_add.html');

		}
	}

	function edit($f3, $args) {

		$p = $this->people;

		if (empty($args['pid'])) { // edit self info
			
			$pid = $f3->get('SESSION.PID');
			$p->load(array('pID=?',$pid));

			if ($f3->exists('POST.update')) {

				$p->copyFrom('POST');
				if ($p->birthday=='') $p->birthday = NULL;
				$p->save();

				$f3->reroute('/self/show');

			} else {

				$p->copyto('person');
				$f3->set('pageTitle', 'Info');
				$f3->set('pageContent', 'people/_self_edit.html');

			}

		} else { // edit the normal client

			$pid = $args['pid'];
			$p->load(array('pID=?', $pid));

			if ($f3->exists('POST.update')) {
				
				$p->copyFrom('POST');
				if ($p->birthday=='') $p->birthday = NULL;
				$p->save();

				$f3->reroute('/client/'.$pid);

			} else {

				if ($p->dry()) {
					$f3->error(404);
					die;
				} else {
					$p->copyto('person');
				}
				$f3->set('pageTitle', 'Client Info Edit');
				$f3->set('pageContent', 'people/_edit.html');

			}
		}
	}

	function del($f3, $args) {
	    
	    $p = $this->people;	
		$pid = empty($args['pid'])?'':$args['pid'];
		$p->erase(array('pID=?', $pid));

		$f3->reroute('/client/list');
	}

}

