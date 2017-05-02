<h3><a href="?view=overview">go to overview</a></h3>
<?php
foreach($this->_['entries'] as $entry){
?>

<?php echo $entry['name']; ?> <br />
Action: <a href="?view=view&id=<?php echo $entry['id'] ?>">view</a> <a href="?action=not_completed_todo&id=<?php echo $entry['id'] ?>">not completed</a> <a href="?view=update&id=<?php echo $entry['id']; ?>">update</a> <a href="?action=delete_todo&id=<?php echo $entry['id']; ?>" onclick="return confirm('Do you really want to delete this entry?')">delete</a>
<br /><br />

<?php
}
?>
