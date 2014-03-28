<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="../includes/style.css" />
	<title>Projet Sierra</title>
</head>
<body id="interface">
<?php include("../includes/functions.php"); ?>
<?php include("../includes/connexion_bdd.php");?>
<div id="interface_header">
	<ul>
<?php
$menu = $bdd->query('SELECT * FROM rubriques WHERE niveau="1"') or die(print_r($bdd->errorInfo()));
while($donnees_menu = $menu->fetch())
{
		if($donnees_menu['id_rubrique']=="1"){ ?>
		<li><a href="<?php echo urlSite(); ?>">Accéder à <?php echo nomSite(); ?></a></li>
<?php }else{ ?>
		<li>
			<a href="<?php echo $donnees_menu['url']; ?>"><?php echo $donnees_menu['titre']; ?></a>
			<?php 
			$menu_niveau2 = $bdd->prepare('SELECT * FROM rubriques WHERE niveau="2" AND id_rubrique_parent="3"');
			$menu_niveau2->execute(array(
				'id_rubrique_parent' => $donnees_menu['id_rubrique'],
			));?>
			<ul class="niveau2">
			<?php
			$donnees_menu_niveau2 = $menu_niveau2->fetch();
			print_r($donnees_menu_niveau2);die();
			while($donnees_menu_niveau2 = $menu_niveau2->fetch())
			{ ?>
				<li><a href="<?php echo $donnees_menu_niveau2['url']; ?>"><?php echo $donnees_menu_niveau2['titre']; ?></a></li>
		<?php } $menu_niveau2->closeCursor();?>
			</ul>
		</li>
<?php }
}
$menu->closeCursor();
?>
		<li><a href="<?php echo urlSite(); ?>">Accéder à <?php echo nomSite(); ?></a></li>
    	<li><a href="dashboard.php">Tableau de bord</a></li>
		<li><a href="gestion_site.php">Gestion du site</a>
			<ul class="niveau2">
				<li><a href="gestion_site.php">Catégories</a></li>
				<li><a href="gestion_site.php">Produits</a></li>
			</ul>
		</li>
        <li><a href="clients.php">Clients</a></li>
        <li><a href="fournisseurs.php">Fournisseurs</a></li>
	</ul>
</div>
