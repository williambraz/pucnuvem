<?php

require_once("../../banco/conexao.php");

header('Content-Type: text/html; charset=utf-8');

session_start();

$login = htmlspecialchars($_POST['login']);
$senha = htmlspecialchars($_POST['senha']);
$nomeCompleto = htmlspecialchars($_POST['nomeCompleto']);
$arquivoFoto = htmlspecialchars($_FILES['arquivoFoto']["name"]);
$cidade = htmlspecialchars($_POST['cidade']);
$email = htmlspecialchars($_POST['email']);
$descricao = htmlspecialchars($_POST['descricao']);

$sql = "SELECT * FROM participantes where login = '$login'";
$query = $mysqli->query($sql);

$resultado = mysqli_fetch_array($query);

// Verifica se encontrou algum registro
if (empty($resultado)) 
{
  // Nenhum registro foi encontrado => não existe usuário cadastrado com este login
  $permissoes = array("gif", "jpeg", "jpg", "png", "image/gif", "image/jpeg", "image/jpg", "image/png");  //strings de tipos e extensoes validas

  /*echo $_FILES["arquivoFoto"]["name"];
  echo $_FILES["arquivoFoto"]["type"];
  echo $_FILES["arquivoFoto"]["size"];*/

  $temp = explode(".", basename($_FILES["arquivoFoto"]["name"]));
  $extensao = end($temp);

  if ((in_array($extensao, $permissoes)) && (in_array($_FILES["arquivoFoto"]["type"], $permissoes)) && ($_FILES["arquivoFoto"]["size"] < $_POST["MAX_FILE_SIZE"]))
  {
    if ($_FILES["arquivoFoto"]["error"] > 0)
    {
        include_once("./modelos/cabecalho.html");
        include_once("./modelos/menu_home.html");
        echo "<h3>Erro no envio da imagem, código: " . $_FILES["arquivoFoto"]["error"] . "</h3>";
        echo "<a href='cadastro.php' class='linkpreto'>Voltar</a>";
        include_once("./modelos/rodape.html");
    }
    else
    {
      $caminhoUpload = "imagens/";
      $extensao = pathinfo($arquivoFoto, PATHINFO_EXTENSION);
      $nomeUpload = $login.".".$extensao;
      $pathCompleto = $caminhoUpload.basename($nomeUpload);
      
      if(move_uploaded_file($_FILES["arquivoFoto"]["tmp_name"], $pathCompleto))
      {
        $sql = "INSERT INTO participantes (login, senha, nomeCompleto, arquivoFoto, cidade, email, descricao) VALUES ('$login','$senha','$nomeCompleto','$nomeUpload','$cidade','$email','$descricao')";
        $query = $mysqli->query($sql);

        $_SESSION['login'] = $login;
        $_SESSION['senha'] = $senha;
        $_SESSION['nome'] = $nomeCompleto;
        $_SESSION['foto'] = $nomeUpload;
        $_SESSION['email'] = $email;
        $_SESSION['descricao'] = $descricao;

        header("Location: principal.php");
      }
      else
      {
        include_once("./modelos/cabecalho.html");
        include_once("./modelos/menu_home.html");
        echo "<h3>Foi encontrado um problema na criação do cadastro. Favor tentar novamente.</h3>";
        echo "<a href='cadastro.php' class='linkpreto'>Voltar</a>";
        include_once("./modelos/rodape.html");
      }
    }
  }
  else
  {
    include_once("./modelos/cabecalho.html");
    include_once("./modelos/menu_home.html");
    echo "<h3>Imagem de perfil em formato inválido.</h3>";
    echo "<a href='cadastro.php' class='linkpreto'>Voltar</a>";
    include_once("./modelos/rodape.html");  
  }
} 
else 
{
  include_once("./modelos/cabecalho.html");
  include_once("./modelos/menu_home.html");
  echo "<h3>Nome de usuário já cadastrado</h3>";
  echo "<a href='cadastro.php' class='linkpreto'>Voltar</a>";
  include_once("./modelos/rodape.html");  
}
?> 