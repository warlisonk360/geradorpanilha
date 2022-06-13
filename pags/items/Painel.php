<?php
include("connect/conexao.php");

$nomeUsuario = Url::getURL(2);

$stmt = $pdo->prepare("SELECT * FROM controlelogin WHERE usuario=?");
$stmt->execute([$nomeUsuario]);

$linha = $stmt->fetch();

if (!$linha) {
    exit(header('Location:'.URL::getBase().'Pagina/Login'));
}

$sql = $pdo->prepare("SELECT * FROM planilhas");
$sql->execute([$nomeUsuario]);
?>

<div class="w3-bar w3-card-4 w3-dark-grey">

<div class="w3-bar-item w3-center" style="width:40%">
  <h3>Logado(a) como:</h3>
  <?php if ($linha['sexo'] == "homem" ) { ?>
    <img src="<?php echo URL::getBase(); ?>img/male.png" alt="<?=$nomeUsuario; ?>" style="width:20%">
  <?php } else { ?>
    <img src="<?php echo URL::getBase(); ?>img/woman.png" alt="<?=$nomeUsuario; ?>" style="width:20%">
  <?php } ?>
  <h5><?=$nomeUsuario; ?></h5>
  <a class="w3-button w3-red" href="<?=URL::getBase();?>" >SAIR</a>
</div>

<div class="w3-bar-item w3-center">
    <a href="<?=URL::getBase();?>Pagina/Criar/<?=$nomeUsuario; ?>"  class="w3-button w3-padding">
        <img src="<?php echo URL::getBase(); ?>img/add_file.png" alt="criar arquivo" style="width:20%">
        CRIAR ARQUIVO
    </a>
</div>

<div class="w3-bar-item w3-center">
    <a href="<?=URL::getBase();?>Pagina/Editar/<?=$nomeUsuario; ?>" class="w3-button w3-padding">
        <img src="<?php echo URL::getBase(); ?>img/reopen_file.png" alt="criar arquivo" style="width:20%">
        EDITAR ARQUIVO
    </a>
</div>

</div>


<div class="w3-container w3-center w3-padding" style="width:60%">
<input type="text" id="usuario" class="w3-input" placeholder="Pesquisar na tabela">
<table class="w3-table-all w3-large" id="tabela">
<thead>
<tr>
      <th>Nomes</th>
      <th>Endereço</th>
      <th>Whatsapp</th>
      <th>Divida</th>
      <th>Apagar</th>
</tr>
</thead>
<tbody> 
<?php
while ($planilhas = $sql->fetch()) {
?>
    <tr>
        <td><?=$planilhas['Nome']?></td>
        <td><?=$planilhas["Endereco"]?></td>
        <td><?=$planilhas['Whatsapp']?></td>
        <td><?=$planilhas['Valor']?></td>
        <td><a class="w3-button w3-text-red" href="<?=URL::getBase();?>Pagina/Apagar/<?=$nomeUsuario; ?>/Painel/<?=$planilhas['ID']?>" >x</a></td>
    </tr>   
<?php
}
?>
</tbody>
</table>
<button id="anterior" disabled>&lsaquo; Anterior</button>
		<span id="numeracao"></span>
		<button id="proximo" disabled>Próximo &rsaquo;</button>	
</div>


<script>
var tamanhoPagina = 6;
var pagina = 0;

var dados = $('table > tbody > tr');

function paginar() {
    $('table > tbody > tr').hide();
    //var tbody = $('table > tbody');
    for (var i = pagina * tamanhoPagina; i < dados.length && i < (pagina + 1) *  tamanhoPagina; i++) {
            $(dados[i]).show()
    }
    $('#numeracao').text('Página ' + (pagina + 1) + ' de ' + Math.ceil(dados.length / tamanhoPagina));
}

function ajustarBotoes() {
    $('#proximo').prop('disabled', dados.length <= tamanhoPagina || pagina > dados.length / tamanhoPagina - 1);
    $('#anterior').prop('disabled', dados.length <= tamanhoPagina || pagina == 0);
}	

$(function() {
    $('#proximo').click(function() {
        if (pagina < dados.length / tamanhoPagina - 1) {
            pagina++;
            paginar();
            ajustarBotoes();
        }
    });
    $('#anterior').click(function() {
        if (pagina > 0) {
            pagina--;
            paginar();
            ajustarBotoes();
        }
    });
    paginar();
    ajustarBotoes();
});	
    

$(document).ready(function(){
        $("#usuario").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tabela tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        });
});	
</script>