<?php

// unsere Klassen einbinden
include('classes/todoCtrl.php');
include('classes/todoModel.php');
include('classes/view.php');

// $_GET und $_POST zusammenfasen, $_COOKIE interessiert uns nicht.
$request = array_merge($_GET, $_POST);
// Controller erstellen
$controller = new todoCtrl($request);
// Inhalt der Webanwendung ausgeben.
echo $controller->display();

?>
