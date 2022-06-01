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

<div class="w3-container">
  <div class="w3-half w3-padding">
    <p>Uso exclusivo de: <?=$nomeUsuario; ?></p>
    <a class="w3-button w3-red" href="<?=URL::getBase();?>Pagina/Painel/<?=$nomeUsuario; ?>">VOLTAR</a>
  </div>

  <div class="w3-half w3-padding">
    <input class="w3-input w3-border w3-round" id="contagem" name="contagem" type="text">
  </div>

  <div class="w3-half w3-padding">
    <button id="AdicionarFormulario" class="w3-button w3-blue w3-round" >Adicionar</button>
  </div>

</div>


<form class="w3-container w3-card-4 w3-padding-16" method="post" action="<?=URL::getBase();?>Pagina/Gerar/<?=$nomeUsuario; ?>" >

  <div id="campoPaineis" class="w3-container w3-row" >
  <?php
   while ($planilhas = $sql->fetch()) {
  ?>
      <div id="panel" class="w3-panel w3-col s6">
          <h2 class="w3-text-blue">Editar Formulario <a class="w3-button w3-text-red" href="<?=URL::getBase();?>Pagina/Apagar/<?=$nomeUsuario; ?>/<?=$planilhas['ID']?>" >x</a></h2>
          
          <p>      
          <label class="w3-text-blue"><b>Nome</b></label>
          <input class="w3-input w3-border w3-round" name="dados[nomes][]" type="text" value="<?=$planilhas['Nome']?>"></p>

          <p>      
          <label class="w3-text-blue"><b>Endereço</b></label>
          <input class="w3-input w3-border w3-round" name="dados[endereco][]" type="text" value="<?=$planilhas['Endereco']?>"></p>

          <p>      
          <label class="w3-text-blue"><b>Whatsapp</b></label>
          <input id="phone" class="w3-input w3-border w3-round" name="dados[whatsapp][]" type="text" value="<?=$planilhas['Whatsapp']?>"></p>

          <p>
          <label class="w3-text-blue"><b>Valor da Divida</b></label>
          <input id="money" class="w3-input w3-border w3-round" name="dados[divida][]" type="text" value="<?=$planilhas['Valor']?>"></p>
      </div>
      <?php } ?>
  </div>


  <button class="w3-btn w3-blue">Gerar Documento</button>
</form>

<script>
$(document).ready(function(){  
  
  var campoPaines = $("#campoPaineis");
  var panel = $("#panel");

  $(document).on("focus", "#money", function() { 
      $(this).mask('000.000.000.000.000,00', {reverse: true});
  });  

  $(document).on("focus", "#phone", function() { 
      $(this).mask('(00) 0 0000-0000');  
  });   

  $("#AdicionarFormulario").click(function(e){
      e.preventDefault();
      let contador = $("#contagem").val();

      if (contador) {
          contador = parseInt(contador);
      }

      for (let index = 0; index < contador; index++) {
          panel.clone().appendTo(campoPaines);
      }
  });


});
</script>