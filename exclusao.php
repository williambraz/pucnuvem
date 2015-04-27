<?php
    require_once("../../banco/conexao.php");
    require_once("./sessao.php");
?>

<?php
    include_once("./modelos/cabecalho.html");
    include_once("./modelos/menu.html");
?>

<section class="row">
    <form class="form-group" action="./excluir.php" method="post" enctype="multipart/form-data" role="form">
        <div class="form-group col-sm-12">
            <label>Confirma exclusão?</label>
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