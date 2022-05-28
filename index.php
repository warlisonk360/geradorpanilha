<?php 
require "classes/Url.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Gerador de Planilhas</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">     
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="<?=URL::getBase();?>js/jquery.mask.min.js"></script>

    <style>
    body,h1,h2,h3,h4,h5,h6 {font-family: "Karma", sans-serif}
    .w3-bar-block .w3-bar-item {padding:20px}
    hr{
        width: 350px;
        border-color: transparent;
    }
    </style> 
       
</head>
<body class="w3-light-grey">

    <div id="principal" class="text-center">
        <?php
        $modulo = Url::getURL( 0 ); 

        if( $modulo == null )
            $modulo = "pagina";

        if( file_exists( "pags/" . $modulo . ".php" ) )
            require "pags/" . $modulo . ".php";
        else
            require "pags/404.php";
        ?>
    </div>
 
</body>
</html> 