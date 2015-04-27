<?php
    require_once("./banco/conexao.php");
    require_once("./sessao.php");
?>

<?php
    include_once("./modelos/cabecalho.html");
    include_once("./modelos/menu.html");
?>
  <script type="text/javascript">

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
    <section class="row">
            <form action="./editar.php" method="post" enctype="multipart/form-data" class="form-group" role="form" onsubmit="return validaForm()">
                
                <div class="form-group col-sm-12">
                    <input type="hidden" name="MAX_FILE_SIZE" value="500000" >
                    
                    <label for="nomeCompleto">Nome: </label>
                    <input id="nomeCompleto" class="form-control" name="nomeCompleto" value="<?php echo $nome ?>" maxlength="50" required autofocus>
                </div>

                <div class="form-group col-sm-12">
                    <label for="email">Email: </label>
                    <input id="email" class="form-control" name="email" type="email" value="<?php echo $email ?>" maxlength="50" required autofocus>
                </div>

                <div class="form-group col-sm-12">
                    <label for="senha">Senha: </label>
                    <input id="senha" class="form-control" name="senha" type="password" placeholder="Senha" maxlength="50" required autofocus>
                </div>

                <div class="form-group col-sm-12">
                    <label for="confSenha">Confirmar Senha: </label>
                    <input id="confSenha" class="form-control" name="confSenha" type="password" placeholder="Confirme" maxlength="50" required autofocus>
                </div>

                <div class="form-group col-sm-12">
                    <label for="estado">Estado: </label>
                    <select class="form-control" name="estado" onchange="carregarCidades(this.value);" autofocus> 
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
                    <select class="form-control" id="cidade" name="cidade" autofocus></select>
                </div>

                <div class="form-group col-sm-12">
                    <label for="descricao">Descrição: </label>
                    <textarea class="form-control" rows="4" cols="80" required autofocus><?php echo "$descricao" ?></textarea> 
                </div>
                                 
                <div class="form-group">
                    <div class="col-md-4 center-block">
                        <button class="btn btn-default" type="button" onclick="location.href='principal.php'">Voltar</button>
                        <button class="btn btn-default" type="submit">Enviar</button> 
                    </div>
                </div>

            </form>
    </section>

<?php
    include_once("./modelos/rodape.html");
?>