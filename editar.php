<?php

require_once("./banco/conexao.php");
require_once("./sessao.php");

$senha = htmlspecialchars($_POST['senha']);
$nomeCompleto = htmlspecialchars($_POST['nomeCompleto']);
$cidade = htmlspecialchars($_POST['cidade']);
$email = htmlspecialchars($_POST['email']);
$descricao = htmlspecialchars($_POST['descricao']);

if ($cidade == "")
{
  $sql = "UPDATE participantes SET senha='$senha', nomeCompleto='$nomeCompleto', email='$email', descricao='$descricao' WHERE login='$login'";
}
else
{
   $sql = "UPDATE participantes SET senha='$senha', nomeCompleto='$nomeCompleto', cidade='$cidade', email='$email', descricao='$descricao' WHERE login='$login'";  
}

$query = $mysqli->query($sql);

$_SESSION['senha'] = $senha;
$_SESSION['nome'] = $nomeCompleto;
$_SESSION['email'] = $email;
$_SESSION['descricao'] = $descricao;

header("Location: principal.php");

?> 