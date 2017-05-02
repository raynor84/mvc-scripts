<h3><a href="?view=add">Add an entry</a></h3>
<?php
foreach($this->_['entries'] as $entry){
?>

<?php echo $entry['date']; ?> <?php echo $entry['weight']; ?> kg<br />
Action: <a href="?view=view&id=<?php echo $entry['id'] ?>">view</a> <a href="?view=update&id=<?php echo $entry['id']; ?>">update</a> <a href="?action=delete_weight&id=<?php echo $entry['id']; ?>" onclick="return confirm('Do you really want to delete this entry?')">delete</a>
<br /><br />

<?php
}
?>
