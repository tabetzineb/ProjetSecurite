<?php 
session_start();

if ($_SESSION['statuts']==1) {

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>admin</title>
</head>
<body>
<?php 

// si la variable msg2 existe,( passé en url depuis le script cnx.php) donc le isset afficheras true et la condition if s'executeras 
if(isset($_GET['msg2'])){

//on affiche un script js(java scripte qui va nous afficher une boite de dialogue js qui indiqueras un message de bienvenue a l'espace admin)
echo("<script>");
echo("alert('Vous etes desormais connecter à l espace admin ,Bienvenue !!')");
echo("</script>");
}
?>


<p>  bievenue <?php echo $_SESSION['nom']; ?> à votre espace admin</p>

</body>
</html>
<?php
}
?>

