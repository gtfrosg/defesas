<?php
header("Content-type: text/html;charset=utf-8");
require('../config.php');
$user = new Users;
$sala = new Sala;
$status = $user->verificarStatus();
$todos = $sala->listarSalas();
$configdocs = new ConfigDocs;
$info = $configdocs->ver();
if($status != 2 && $status != 1) 	die('Você não possui acesso a esta área');


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<link rel="stylesheet" href="../defesas.css" type="text/css" media="all" />
	<title> </title>
</head>

<body>

<div id="wrapper">
	<div id="header">
	<?php echo $info[0]['sitename']; ?>
	</div>

	<div id="leftsidebar">
	<?php include('menu.php'); ?>
	</div>

<div id="bodycontent">
<h1>Salas</h1>

<table class="table" cellspacing='0'>
<tr>
<th>Sala</th>
<th>Prédio</th>
<th colspan="2"><center>Operações</center> </th>
</tr>
<?php foreach ($todos as $value) { ?>
<tr> 
 <td>
  <?php echo $value['nome_sala']; ?> 
 </td>
 <td>
  <?php echo $value['predio']; ?>
 </td>
	<td>  
 <a href="./alterarSala.php?code_sala=<?php echo $value['code_sala'] ?>"> <img src="../images/editar.png"></a>
 </td>
	<td>
 <a href="./apagarSala.php?code_sala=<?php echo $value['code_sala'] ?>"> <img src="../images/excluir.png"></a>
 </td>
</tr>
<?php } ?>
</table>
</div>
	<div id="footer" class="clear">
	<?php print $info[0]['rodape_site']; ?>
	</div>
</div>

</body>
</html>


<?php
if(isset($_GET['erro']) && $_GET['erro'] == 'fatal') {
	echo "<script LANGUAGE=\"Javascript\" > alert(\"Impossível apagar! Candidatos estão cadastrados nesta sala \"); 
   self.location = 'verSalas.php';
   </script>";
}
?>

