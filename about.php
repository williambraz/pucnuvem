<?php
    require_once("../../banco/conexao.php");
    require_once("./Pessoa.class.php");
    require_once("./Usuarios.class.php");
    require_once("./sessao.php");

    $usuario = new Usuarios();
    $id = $_GET['id'];

    $sql = "SELECT * from participantes where login = '$id'";
    $query = $mysqli->query($sql);
    
    while ($dados = mysqli_fetch_array($query))
    {
        $sql2 = "SELECT nomeCidade from cidades where idCidade = ".$dados['cidade'];
        $query2 = $mysqli->query($sql2);

        while ($dados2 = mysqli_fetch_array($query2))
        {
            $usuario = new Pessoa($dados['nomeCompleto'], $dados['login'], $dados['arquivoFoto'], $dados2['nomeCidade'], $dados['email'], $dados['descricao']); //cria um objeto "Pessoa" com esses dados
            $expire=time()+60*60*24*30;
            setcookie("perfil_visitado", $dados['nomeCompleto'], $expire);
            setcookie("login_visitado", $dados['login'], $expire);
        }
    }
?>

<?php
    include_once("./modelos/cabecalho.html");
    include_once("./modelos/menu.html");
?>        
    <section id="usuario" class="row">
     
            <?php

                $usuario->mostraGeral();
                //$usuarios->mostrarGeral();
            ?>
            
            <div class="clear"></div>
            
            <nav id="voltar" class="navbar navbar-default" role="navigation">
              <div class="nav navbar-nav">
                <a href="principal.php">
                    <button type="button" class="btn btn-default">
                      <span class="glyphicon glyphicon-arrow-left"></span> Voltar
                    </button>
                </a>
            </nav>

    </section>
        
<?php
    include_once("./modelos/rodape.html");
?>
