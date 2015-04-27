<?php

require_once("../../banco/conexao.php");
require_once("./sessao.php");

$arquivoFoto = utf8_encode(htmlspecialchars($_FILES['arquivoFoto']["name"]));

$permissoes = array("gif", "jpeg", "jpg", "png", "image/gif", "image/jpeg", "image/jpg", "image/png");  //strings de tipos e extensoes validas

$temp = explode(".", basename($_FILES["arquivoFoto"]["name"]));
$extensao = end($temp);

if ((in_array($extensao, $permissoes)) && (in_array($_FILES["arquivoFoto"]["type"], $permissoes)) && ($_FILES["arquivoFoto"]["size"] < $_POST["MAX_FILE_SIZE"]))
{
  if ($_FILES["arquivoFoto"]["error"] > 0)
  {
      include_once("./modelos/cabecalho.html");
      include_once("./modelos/menu_home.html");
      echo "<h3>Erro no envio da imagem, código: " . $_FILES["arquivoFoto"]["error"] . "</h3>";
      echo "<a href='edicao_foto.php' class='linkpreto'>Voltar</a>";
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
      $sql = "UPDATE participantes SET arquivoFoto='$nomeUpload' WHERE login='$login'";
      $query = $mysqli->query($sql);

      $_SESSION['foto'] = $nomeUpload;

      header("Location: principal.php");
    }
		else
    {
    include_once("./modelos/cabecalho.html");
    include_once("./modelos/menu_home.html");
    echo "<h3>Imagem de perfil em formato inválido.</h3>";
    echo "<a href='edicao_foto.php' class='linkpreto'>Voltar</a>";
    include_once("./modelos/rodape.html");  
    }
  }
}
else
{
    include_once("./modelos/cabecalho.html");
    include_once("./modelos/menu_home.html");
    echo "<h3>Imagem de perfil em formato inválido.</h3>";
    echo "<a href='edicao_foto.php' class='linkpreto'>Voltar</a>";
    include_once("./modelos/rodape.html");  
}
?> 