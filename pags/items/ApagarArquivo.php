<?php 
include("connect/conexao.php");

$caminho = Url::getURL(3);
$nomeUsuario = Url::getURL(2);
$id = Url::getURL(4);

$stmt = $pdo->prepare("SELECT * FROM controlelogin WHERE usuario=?");
$stmt->execute([$nomeUsuario]);

$linha = $stmt->fetch();

if (!$linha) {
    exit(header('Location:'.URL::getBase().'Pagina/Login'));
}

$sql = "DELETE FROM planilhas WHERE id=?";
$stmt= $pdo->prepare($sql);
$stmt->execute([$id]);


header('Location:'.URL::getBase().'Pagina/'.$caminho.'/'.$nomeUsuario);
?>