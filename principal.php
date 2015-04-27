<?php
    require_once("../../banco/conexao.php");
    require_once("./Pessoa.class.php");
    require_once("./Usuarios.class.php");
    require_once("./sessao.php");
?>

<?php
    include_once("./modelos/cabecalho.html");
    include_once("./modelos/menu.html");
?>
    <script type="text/javascript">
        
        function filtrarUsuarios()
        {
            var busca =  $('#campo_busca').val();  
            filtrar(busca);
        }

        function resetarFiltro()
        {
            var busca =  "";
            filtrar(busca);
        }

        function limparUsuarios()
        {
           $('#fotos').empty(); 
        }

        function filtrar(filtro)
        {
            var login_atual = <?php echo "'$login'" ?>;

            $.ajax({
                url:'busca_usuarios.php',
                type:'POST',
                data: 'nome='+filtro+'&login='+login_atual,
                dataType: 'json',
                success: function( json ) 
                {
                    limparUsuarios();

                    $.each(json, function(i, dados) 
                    {
                        $('#fotos').append("<figure class='thumbs'><a href='about.php?id="+dados['login']+"'><img src='imagens/"+dados['arquivoFoto']+"' title='"+dados['nomeCompleto']+"' alt='"+dados['nomeCompleto']+"'/><figcaption><a href='about.php?id="+dados['login']+"'> "+dados['nomeCompleto']+" </a></figcaption></a></figure>");
                    });
                }
            });
        }

    </script>  

    <section class="row">
        <form role="form" name="formlogin" class="form-group">
            <div class="col-sm-3 col-md-4"></div>
            <div id="busca" class="form-group col-xs-12 col-sm-6 col-md-4">
                <label class="lblform" for="login"><span class="glyphicon glyphicon-search"  style="margin-right:3px;"></span>Busca: </label>
                <input id="campo_busca" class="form-control" type="text" name="login" value=""/>
                <div style="margin-top:15px">
                    <input type="button" class="btn btn-default" onclick="filtrarUsuarios()"  value="Buscar"/>
                    <input type="button" class="btn btn-default" onclick="resetarFiltro()" value="Limpar" />
                </div>
            </div>
            <div class="col-sm-3 col-md-4"></div>
        </form>

    </section>

    <section id="perfil_visitado">
        <?php 
            if (isset($_COOKIE["perfil_visitado"]))
            {
                $login_visitado = $_COOKIE['login_visitado'];
                echo "<p>Último perfil visitado:  <a class='linkpreto' href='about.php?id=$login_visitado'>" . $_COOKIE["perfil_visitado"] . "</a></p>"; 
            }
        ?>
    </section>

    <section class="row">
        <div class='col-xs-1'></div>
        <div class="col-xs-10 center-block">
            <div id="fotos">
                    
                <?php

                    $usuarios = new Usuarios();

                    $sql = "SELECT * from participantes where login <> '$login' order by nomeCompleto";
                    $query = $mysqli->query($sql);
                    
                    while ($dados = mysqli_fetch_array($query))
                    {
                        $usuario = new Pessoa($dados['nomeCompleto'], $dados['login'], $dados['arquivoFoto'], $dados['cidade'], $dados['email'], $dados['descricao']); //cria um objeto "Pessoa" com esses dados
                        $usuarios->addPessoa($usuario);   
                    }

                    $usuarios->mostrarThumb();
                    //$usuarios->mostrarGeral();    
                ?>
                    
            </div>
        </div>
        <div class='col-xs-1'></div>
            
    </section>

<?php
    include_once("./modelos/rodape.html");
?>