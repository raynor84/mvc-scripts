<h2><?php echo $this->_['name']; ?></h2>
<?php if(array_key_exists('subtasks', $this->_) && !empty($this->_['subtasks'])):?> 
	<ul>
	<?php foreach($this->_['subtasks'] as $task) :?>
		<li>
			<?php echo $task['name']; ?><br />
			Action: <a href="?view=view&id=<?php echo $task['id'] ?>">view</a> 
			<a href="?view=update&id=<?php echo $task['id']; ?>">update</a> 
			<a href="?action=completed_todo&id=<?php echo $task['id']; ?>">completed</a> 
			<a href="?action=delete_todo&id=<?php echo $task['id']; ?>" onclick="return confirm('Do you really want to delete this entry?')">delete</a>
		</li>
	<?php endforeach; ?>
	</ul>
<?php endif; ?>
<a href="?view=deafult">Zur&uuml;ck zur &Uuml;bersicht</a>
