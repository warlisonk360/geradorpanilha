<?php if(!isset($_POST['submit'])) exit(header('Location:'.URL::getBase()));
include("connect/conexao.php");

$nome = $_POST['username'];
$senha = MD5($_POST['password']);

if (isset($nome) && isset($senha) && $nome != "" && $senha != "") {
    $stmt = $pdo->prepare("SELECT * FROM controlelogin WHERE usuario=? AND senha=?");
    $stmt->execute([$nome, $senha]);

    $linha = $stmt->fetch();

    if ($linha['usuario'] != $nome && $linha['senha'] != $senha) {
        exit(header('Location:'.URL::getBase().'Pagina/Login/erro1'));
    }

    header('Location:'.URL::getBase().'Pagina/Painel/'.$linha['usuario']);
    
} else {
    exit(header('Location:'.URL::getBase().'Pagina/Login'));
}

?>