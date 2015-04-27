<?php

require_once("./Pessoa.class.php");

class Usuarios
{
    public $pessoas;   //vetor de pessoas.
	
        
    /* método construtor
     * inicializa propriedades
     */
   function __construct()
    {
        $this->pessoas = array();
    }	
		
	function addPessoa(Pessoa $p){
	   array_push($this->pessoas, $p);
	}
     
	function mostrarThumb(){
	   foreach($this->pessoas as $pessoa){
		   $pessoa->mostraThumb();
		 }
	}

	function mostrarGeral(){
	   foreach($this->pessoas as $pessoa){
		   $pessoa->mostraGeral();
		 }
	} 
}
?>
