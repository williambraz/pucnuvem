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
            <form action="./editar_foto.php" method="post" enctype="multipart/form-data" class="form-group" role="form" onsubmit="return validaForm()">
                
                <div class="form-group col-sm-12">
                    <input type="hidden" name="MAX_FILE_SIZE" value="500000" >

                    <label for="arquivoFoto">Foto do perfil (max. 500kb): </label>
                    <input type="file" class="form-control" name="arquivoFoto" id="arquivoFoto" placeholder="Escolha um arquivo">
                </div>
                
                <div class="form-group col-sm-12">
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