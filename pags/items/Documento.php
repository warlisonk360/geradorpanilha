<div class="w3-container">
<p><i class="fa fa-arrow-right"> VISUALIZAR DOCUMENTO</i></p>


<div class="w3-panel w3-padding w3-right">
    <a href="<?=URL::getBase();?>" ><button class="w3-button w3-red">VOLTAR</button></a>
</div>

<table class="w3-table-all w3-large" id="geraPDF">
<thead>
<tr>
      <th>Nomes</th>
      <th>Endereço</th>
      <th>Whatsapp</th>
      <th>Divida</th>
      <th>Assinatura</th>
</tr>
</thead>
<tbody>   
<?php
$dados = $_POST["dados"];

$nomes = $dados["nomes"];
$enderecos = $dados["endereco"];
$whats = $dados["whatsapp"];
$divida = $dados["divida"];


$cont = count($dados['nomes']);

for ($i=0; $i < $cont; $i++) { 
?>
    <tr>
        <td><?=$dados['nomes'][$i]?></td>
        <td><?=$dados["endereco"][$i]?></td>
        <td><?=$dados['whatsapp'][$i]?></td>
        <td><?=$dados['divida'][$i]?></td>
        <td><hr></td>
    </tr>
<?php

}

?>
</tbody>
</table>
<div class="w3-panel w3-padding w3-right">
    <button id="btnPDF" class="w3-button w3-black" >GERAR DOCUMENTO</button>
</div>

</div>
<script src="<?=URL::getBase();?>js/jspdf.umd.min.js"></script>
<script src="<?=URL::getBase();?>js/jspdf.plugin.autotable.js"></script>
<script>
window.jsPDF = window.jspdf.jsPDF;
window.html2canvas = html2canvas;

$(document).ready(function(){
    $('#btnPDF').click(function() {
      savePDF();
    });
});

function savePDF() {

    var numero = Math.floor(Math.random() * 999999999) + 1;

    const doc = new jsPDF('p', 'mm', 'a4');
    doc.autoTable({ html: '#geraPDF', theme: 'grid',
    columnStyles: {
        0: {cellWidth: 'auto'},
        1: {cellWidth: 'auto'},
        2: {cellWidth: 'auto'},
        3: {cellWidth: 'auto'},
        4: {cellWidth: 50},
    },
    headStyles: {
        halign: 'center',
    }
    });
    doc.save('relatorio_'+numero+'.pdf');   
}   
</script>