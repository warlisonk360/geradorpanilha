<?php 
if(empty($_SERVER['REQUEST_URI'])){
   header('Location:'.URL::getBase());
}

$nome = Url::getURL(1);

if(empty($nome)){
	include("items/started.php");
}

if($nome == "Login"){
	include("items/Logar.php");
}

if($nome == "verificarLogin"){
	include("items/Controle.php");
}

if($nome == "Painel"){
	include("items/Painel.php");
}

if($nome == "Criar"){
	include("items/CriarArquivo.php");
}

if($nome == "Gerar"){
	include("items/GerarDocumento.php");
}

if($nome == "Editar"){
	include("items/EditarArquivo.php");
}

if($nome == "Apagar"){
	include("items/ApagarArquivo.php");
}

if($nome == "Visualizar"){
	include("items/Documento.php");
}
?>