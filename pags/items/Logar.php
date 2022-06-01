<?php
$idErro = Url::getURL(2);

$mensagemErro = "";

if (isset($idErro) && $idErro != "") {
   if ($idErro == "erro1") {
        $mensagemErro = "Usuario ou Senha Incorreta";
   }
}
?>

<div class="w3-container w3-teal">
  <h2>Painel de Login</h2>
</div>

<?php if ($mensagemErro != "") { ?>
<div class="w3-container w3-red">
        <p><?=$mensagemErro;?></p>
</div>
<?php } ?>

<div class="w3-container w3-padding-16">
<form class="w3-container" method="post" action="<?=URL::getBase();?>Pagina/verificarLogin">

    <div class="w3-padding w3-center" style="width:400px">
        <label class="w3-text-teal"><b>Login</b></label>
        <input id="username" name="username" class="w3-input w3-border w3-light-grey" type="text" required>
    </div>

    <div class="w3-padding w3-center" style="width:400px">
        <label class="w3-text-teal"><b>Senha</b></label>
        <input id="password" name="password" class="w3-input w3-border w3-light-grey" type="password" required>
    </div>    

    <div class="w3-padding-16" >
        <button type="submit" id="submit" name="submit" class="w3-btn w3-blue-grey">Entrar</button>
    </div>

</form>
</div>