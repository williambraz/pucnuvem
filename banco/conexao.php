<?php
	$servidor = 'br-cdbr-azure-south-a.cloudapp.net';
   	$usuario = 'ba1eea200d28a5';
	$senha = '24c95859';
	$banco = 'bancopuc';

	// Conecta-se ao banco de dados MySQL
	$mysqli = new mysqli($servidor, $usuario, $senha, $banco);
	mysqli_set_charset($mysqli,"utf8");

	// Caso algo tenha dado errado, exibe uma mensagem de erro
	if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
?>