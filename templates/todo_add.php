<h3>Add</h3>
<form action="?action=create" method="GET">
	<input type="hidden" name="action" value="create_todo" />
	<select name="subtask_of">
		<?php if(array_key_exists("entries", $this->_)): ?>
			<option value=0></option>
			<?php foreach($this->_["entries"] as $task): ?>
				<option value="<?php echo $task["id"]; ?>"><?php echo $task["name"]; ?></option>
			<?php endforeach; ?>
		<?php endif; ?>
	</select><br />
	<input type="text" name="name" placeholder="name"/><br />
	<input type="submit" name="submit" value="Submit">
</form>
