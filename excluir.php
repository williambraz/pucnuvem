<?php

require_once("./banco/conexao.php");
require_once("./sessao.php");

$sql = "DELETE FROM participantes WHERE login = '$login'";
$query = $mysqli->query($sql);

header("Location: logout.php");

?> 