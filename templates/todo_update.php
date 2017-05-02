<h3>Update</h3>
<form action="" method="GET">
	<input type="hidden" name="action" value="save_todo" />
	<input type="hidden" name="id" value="<?php echo $this->_['entry']['id']; ?>" />
	<input type="text" name="name" placeholder="name" value="<?php echo $this->_['entry']['name']; ?>" /><br />
	<input type="submit" name="submit" value="Submit">
</form>
