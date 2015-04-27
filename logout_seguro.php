<?php
    session_start();
    session_destroy();

    //seta todos os cookies com vencimento no passado, invalidando-os
    foreach($_COOKIE as $key=>$ck)
    {
    	setcookie($key, $ck, time()-3600); 
	}

    header("Location: index.php");
?>