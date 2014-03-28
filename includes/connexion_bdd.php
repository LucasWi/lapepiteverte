<?php
try{
	$bdd = new PDO('mysql:host=localhost;dbname=projet_sierra', 'root', '');
}catch (Exception $e){
	die('Erreur : ' . $e->getMessage());
}
?>