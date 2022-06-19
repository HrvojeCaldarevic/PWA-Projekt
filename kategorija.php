<?php
include 'connect.php';
$kategorija=$_GET[kategorija];
$query = "SELECT * FROM vijesti WHERE kategorija=$kategorija";
?>