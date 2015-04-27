<?php

	class Pessoa
	{
 	    public $nome;
		public $login;
	    public $fotoPerfil;
	    public $cidade;
	    public $email;
	    public $descricao;
	    
	    /* método construtor
	     * inicializa propriedades
	     */
	   function __construct($nome, $login, $foto, $cidade, $email, $descricao) 
	   {
	       $this->nome = $nome;
	 	   $this->login = $login;
	       $this->fotoPerfil = "imagens/{$foto}";
	       $this->cidade = $cidade;
	       $this->email = $email;
	       $this->descricao = $descricao;

	       /*echo "$nome";
	       echo "$login";
	       echo "$this->fotoPerfil";
	       echo "$cidade";
	       echo "$email";
	       echo "$descricao";*/
	    }	
		
		public function mostraThumb()
		{
			$nome_exibido = $this->nome;
			
			if (strlen($nome_exibido) > 20)
			{
				$nome_exibido = substr($nome_exibido, 0, 20);
			}

	        echo "<figure class='thumbs'>";
	        echo "<a href='about.php?id=$this->login'><img src='$this->fotoPerfil' title='$this->nome' alt='$this->nome'/></a>";
	        echo "<figcaption><a href='about.php?id=$this->login'> $nome_exibido </a></figcaption>";
	        echo "</figure>";
	    }

	    public function mostraGeral()
	    {
	    	echo "<div class='col-xs-2 col-sm-4'></div>";
	    	echo "<div class='col-xs-8 col-sm-4 center-block'>";
	    	echo "<figure id='imagem_profile'>";
            echo "<img src='$this->fotoPerfil' class='img-responsive col-xs-12 text-center' title='$this->nome' alt='$this->nome'/>";
            echo "</figure>";
            echo "</div>";
            echo "<div class='col-xs-2 col-sm-4'></div>";
            
            echo "<div id='informacoes' class='visible-sm visible-md visible-lg col-xs-12 col-sm-12'>";
            echo "<h2> $this->nome </h2>";
            echo "</div>";

            echo "<div id='informacoes' class='visible-xs col-xs-12 col-sm-4 '>";
            echo "<p> $this->nome </p>";
            echo "</div>";

            echo "<div class='col-xs-12'>";
            echo "<p> <strong>Email:</strong> $this->email </p>";
            echo "<p> <strong>Cidade:</strong> $this->cidade </p>";
            echo "<p> <strong>Sobre:</strong> $this->descricao </p>";
            echo "</div>";
	    }
	}
?>
