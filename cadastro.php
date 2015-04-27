<?php
    require_once("../../banco/conexao.php");
?>

<?php
    include_once("./modelos/cabecalho.html");
    include_once("./modelos/menu_home.html");
?>
  <script type="text/javascript">

    document.getElementById("menu").style.display="none";
    
    $( document ).ready(function() 
    {
        carregarCidades(1);        
    });

    function carregarCidades(valor)
    {
        /*document.forms[0].action = 'cadastro.php';
        document.forms[0].submit();*/
        $.ajax({
            url:'cidades.php',
            type:'POST',
            data: 'estado='+valor,
            dataType: 'json',
            success: function( json ) 
            {
                limparCidades();

                var i = 1;
                $.each(json, function(i, value) {
                    $('#cidade').append($('<option>').text(value["nomeCidade"]).attr('value', value["idCidade"]));
                });
            }
        });
    }

    function limparCidades()
    {
        $('#cidade').find('option').remove().end();
        $('#cidade').append('<option value="">Selecione</option>');
    }

    function validaForm()
    {
        if ($('#senha').val() == $("#confSenha").val())
        {
            return true;
        }
        else
        {
            alert("As senhas não são iguais. Redigite.")
            return false;
        }
    }

  </script>      

    <section id="form_cadastro" class="form_dados">
            <form role="form" action="./cadastrar.php" method="post" enctype="multipart/form-data" class="form-group" onsubmit="return validaForm()">
                <div class="form-group col-sm-12">
                    <input type="hidden" name="MAX_FILE_SIZE" value="500000" >
                    <label for="login">Login: </label>
                    <input id="login" name="login" class="form-control" placeholder="Login" maxlength="20" required autofocus>
                </div>
                                
                <div class="form-group col-sm-12">
                    <label for="nomeCompleto">Nome: </label>
                    <input id="nomeCompleto" name="nomeCompleto" class="form-control" placeholder="Nome" maxlength="50" required autofocus>
                </div>

                <div class="form-group col-sm-12">
                    <label for="email">Email: </label>
                    <input id="email" type="email" name="email" class="form-control" placeholder="Email" maxlength="50" required autofocus>
                </div>

                <div class="form-group col-sm-12">
                    <label for="senha">Senha: </label>
                    <input id="senha" type="password" name="senha" class="form-control" placeholder="Senha" maxlength="50" required autofocus>
                </div>

                <div class="form-group col-sm-12">
                    <label for="confSenha">Confirmar Senha: </label>
                    <input id="confSenha" type="password" name="confSenha" class="form-control" placeholder="Confirme" maxlength="50" required autofocus>
                </div>

                <div class="form-group col-sm-12">
                    <label for="estado">Estado: </label>
                    <select name="estado" onchange="carregarCidades(this.value);" class="form-control" required autofocus> 
                    <option value="">Selecione</option>
                    <?php

                       if (isset($_POST["estado"])) 
                            $estado = $_POST["estado"];
                       
                       else $estado=-1;
                    
                       $consulta = "select * from estados";
                       
                       $query = mysqli_multi_query($mysqli, $consulta);   
                       
                        if ($resultado = mysqli_use_result($mysqli)) 
                        {
                            while ($dados=mysqli_fetch_array($resultado)) 
                            {
                                echo "<option ";
                                if ($estado == $dados["idEstado"]) echo "selected ";
                                echo "value=\"".$dados["idEstado"]."\">".$dados["sigaEstado"];
                                echo "</option>\n";
                            }
                            
                            mysqli_free_result($resultado);    
                        }
                    ?>

                    </select>
                </div>
                
                <div class="form-group col-sm-12">
                    <label for="cidade">Cidade: </label>
                    <select id="cidade" class="form-control" name="cidade" required autofocus></select>
                </div> 

                <div class="form-group col-sm-12">
                    <label for="descricao">Descrição: </label>
                    <textarea id="descricao" class="form-control" name="descricao" rows="4" cols="80" required autofocus></textarea> 
                </div>
                 
                <div class="form-group col-sm-12">
                    <label for="arquivoFoto">Foto do perfil (max. 500kb): </label>
                    <input type="file" class="form-control" name="arquivoFoto" id="arquivoFoto" placeholder="Escolha um arquivo" required>
                </div> 
                
                <div class="form-group">
                    <div class="col-md-4 center-block">
                        <button type="button" class="btn btn-default" onclick="location.href='index.php'">Voltar</button>
                        <button type="submit" class="btn btn-default">Enviar</button> 
                    </div>
                </div>

            </form>
    </section>

    </br>

<?php
    include_once("./modelos/rodape.html");
?>