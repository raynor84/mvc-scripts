<?php
class todoCtrl{

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
				$view->setTemplate('todo_detail');
				$entryid = $this->request['id'];
				$entry = todoModel::getEntry($entryid);
				$entry["subtasks"] = todoModel::getSubtasks($entryid);;
				$view->assign('name', $entry['name']);
				if(array_key_exists('subtasks', $entry)) {
					$view->assign('subtasks', $entry['subtasks']);
				}
				
				break;
				
			case 'update':
				$view->setTemplate('todo_update');
				$entry = todoModel::getEntry($this->request['id']);
				$view->assign('entry', $entry);
				break;
				
			case 'add': 
					$entries = todoModel::getEntries();
					$view->assign('entries', $entries);
					$view->setTemplate('todo_add');
				break;
			case 'completed':
				$entries = todoModel::getCompletedTodos();
				$view->setTemplate('todo_completed');
				$view->assign('entries', $entries);
				break;
			case 'default':
			default:
				$entries = todoModel::getEntries();
				$view->setTemplate('todo_overview');
				$view->assign('entries', $entries);
		}
		
		switch($this->action) {
				case 'create_todo':
					todoModel::newEntry($this->request);
					header('location: todo.php');
				break;
				case 'save_todo':
					todoModel::updateEntry($this->request);
					header('location: todo.php');
				break;
				case 'delete_todo':
					print_r($this->request);
					todoModel::deleteEntry($this->request['id']);
					header('location: todo.php');
				break;
				case 'completed_todo':
					$result = todoModel::getEntry($this->request['id']);
					$result["completed"]=true;
					todoModel::updateEntry($result);
					header('location: todo.php');
				break;
				case 'not_completed_todo':
					$result = todoModel::getEntry($this->request['id']);
					$result["completed"]=0;
					todoModel::updateEntry($result);
					header('location: todo.php');
				break;
		}
		
		$this->view->setTemplate('theblog');
		$this->view->assign('blog_title', 'Todo-List');
		$link = '<a href="?view=completed">show completed Todo\'s</a>';
		$this->view->assign('blog_footer', $link.'<br />Anwendung zum aufschreiben der aktuellen ToDo\'s');
		$this->view->assign('blog_content', $view->loadTemplate());
		return $this->view->loadTemplate();
	}
}
?>
