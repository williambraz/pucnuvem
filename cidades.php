<?php
    require_once("../../banco/conexao.php");
?>

<?php
   
   if (isset($_POST["estado"]))
   {
       $estado = $_POST["estado"];

       $consulta = "select * from cidades where idEstado=".$estado;

       $query = mysqli_multi_query($mysqli, $consulta);
       $retorno = array();

        if ($resultado = mysqli_use_result($mysqli))
        {
            while ($dados=mysqli_fetch_array($resultado)) 
            {
            	$retorno[] = $dados;
            }   

            mysqli_free_result($resultado);    
        } 

        print json_encode($retorno);
    }
?>