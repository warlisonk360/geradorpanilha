<?php 
if(empty($_SERVER['REQUEST_URI'])){
   header('Location:'.URL::getBase());
}

$nome = Url::getURL(1);

if(empty($nome)){
	include("items/started.php");
}

if($nome == "Visualizar"){
	include("items/Documento.php");
}
?>