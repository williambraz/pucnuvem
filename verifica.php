<?php

  session_start();
  
  require_once("./banco/conexao.php");
  
  function validaUsuario($login, $senha, $conexao)
  {
    /*echo "$login";
    echo "$senha";*/

    $sql = "SELECT * FROM participantes where login = '$login' AND senha = '$senha' LIMIT 1";
    $query = $conexao->query($sql);
    $resultado = mysqli_fetch_array($query);

    // Verifica se encontrou algum registro
    if (empty($resultado)) 
    {
      // Nenhum registro foi encontrado => o usuário é inválido
      return false;

    } 
    else 
    {
      // O registro foi encontrado => o usuário é valido
      $_SESSION['login'] = $login;
      $_SESSION['senha'] = $senha;
      $_SESSION['nome'] = $resultado['nomeCompleto'];
      $_SESSION['foto'] = $resultado['arquivoFoto'];
      $_SESSION['email'] = $resultado['email'];
      $_SESSION['descricao'] = $resultado['descricao'];

      return true;
    }
  }

  $login = (isset($_POST['login'])) ? $_POST['login'] : '';
  $senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';

  /*echo "$login";
  echo "$senha";*/

  // Utiliza uma função criada no seguranca.php pra validar os dados digitados
  if (validaUsuario($login, $senha, $mysqli) == true) 
  {
    //echo "achei";
    header("Location: principal.php");
  } 
  else 
  {
    //echo "nao achei";
    header("Location: errologin.php");
  }
?> 