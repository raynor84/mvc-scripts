<?php
class Controller{

	private $request = null;
	private $template = '';
	private $view = null;
	private $action = null;
	/**
	 * Konstruktor, erstellet den Controller.
	 *
	 * @param Array $request Array aus $_GET & $_POST.
	 */
	public function __construct($request){
		$this->view = new View();
		$this->request = $request;
		$this->template = !empty($request['view']) ? $request['view'] : 'default';
		$this->action = !empty($request['action']) ? $request['action'] : null;
	}

	/**
	 * Methode zum anzeigen des Contents.
	 *
	 * @return String Content der Applikation.
	 */
	public function display(){
		$view = new View();
		
		switch($this->template){
			case 'view':
				$view->setTemplate('weightjournal_detail');
				$entryid = $this->request['id'];
				$entry = Model::getEntry($entryid);
				$view->assign('title', $entry['weight']);
				$view->assign('content', $entry['date']);
				
				break;
				
			case 'update':
				$view->setTemplate('weightjournal_update');
				$entry = Model::getEntry($this->request['id']);
				$view->assign('entry', $entry);
				break;
				
			case 'add': 
					$view->setTemplate('weightjournal_add');
				break;
			case 'default':
			default:
				$entries = Model::getEntries();
				$view->setTemplate('weightjournal_overview');
				$view->assign('entries', $entries);
		}
		
		switch($this->action) {
				case 'create_weight':
					Model::newEntry($this->request);
					header('location: weight_journal.php');
				break;
				case 'save_weight':
					Model::updateEntry($this->request);
					header('location: weight_journal.php');
				break;
				case 'delete_weight':
					print_r($this->request);
					Model::deleteEntry($this->request['id']);
					header('location: weight_journal.php');
				break;
		}
		
		$this->view->setTemplate('theblog');
		$this->view->assign('blog_title', 'Weightjournal');
		$this->view->assign('blog_footer', 'Anwendung zum aufschreiben des aktuellen Gewichts');
		$this->view->assign('blog_content', $view->loadTemplate());
		return $this->view->loadTemplate();
	}
}
?>
