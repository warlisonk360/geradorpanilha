<div class="w3-container">
<p><i class="fa fa-arrow-right"> VISUALIZAR DOCUMENTO</i></p>


<div class="w3-panel w3-padding w3-left">
    <input id="retrato" class="w3-check" type="checkbox">
    <label>retrato</label>

    <input id="paisagem" class="w3-check" type="checkbox">
    <label>Paisagem</label>
</div>

<div class="w3-panel w3-padding w3-right">
    <a href="<?=URL::getBase();?>" ><button class="w3-button w3-red">VOLTAR</button></a>
</div>

<table class="w3-table-all w3-large" id="geraPDF">
<thead>
<tr>
      <th style="text-align: center">Nomes</th>
      <th style="text-align: center">Endereço</th>
      <th style="text-align: center">Whatsapp</th>
      <th style="text-align: center">Divida</th>
      <th style="text-align: center">Assinatura</th>
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
        <td style="width: 20%; text-align: center"><?=$dados['nomes'][$i]?></td>
        <td style="width: 20%; text-align: center"><?=$dados["endereco"][$i]?></td>
        <td style="width: 20%; text-align: center"><?=$dados['whatsapp'][$i]?></td>
        <td style="width: 20%; text-align: center"><?=$dados['divida'][$i]?></td>
        <td style="width: 20%; text-align: center"><hr></td>
    </tr>
<?php

}

?>
</tbody>
</table>
<div class="w3-panel w3-padding w3-right">
    <button id="btnPDF" class="w3-button w3-black" >BAIXAR DOCUMENTO</button>
</div>

</div>
<script src="<?=URL::getBase();?>js/jspdf.umd.min.js"></script>
<script src="<?=URL::getBase();?>js/jspdf.plugin.autotable.js"></script>
<script>
window.jsPDF = window.jspdf.jsPDF;
window.html2canvas = html2canvas;


$(document).ready(function(){
    $('#btnPDF').click(function() {
        if ($("#paisagem")[0].checked == false && $("#retrato")[0].checked == true || $("#paisagem")[0].checked == true && $("#retrato")[0].checked == false) {
            savePDF();
        } else {
            alert("Selecione retrato ou paisagem");
        }
    });
});

function savePDF() {

    var numero = Math.floor(Math.random() * 999999999) + 1;

    if ($("#retrato")[0].checked == true) {
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
			lineColor: [0,0,0],
			lineWidth: 0.2,			
		},
		bodyStyles: {
			halign: 'center',
			lineColor: [0,0,0],
			lineWidth: 0.2,			
		}
		});
		doc.save('relatorio_'+numero+'.pdf');
    }

    if ($("#paisagem")[0].checked == true) {
		const doc = new jsPDF('l', 'mm', 'a4');

		doc.autoTable({ html: '#geraPDF', theme: 'grid', 
		columnStyles: {
			0: {cellWidth: 50},
			1: {cellWidth: 50},
			2: {cellWidth: 50},
			3: {cellWidth: 50},
			4: {cellWidth: 50},
		},
		headStyles: {
			halign: 'center',
			lineColor: [0,0,0],
			lineWidth: 0.2,
		},
		bodyStyles: {
			halign: 'center',
			lineColor: [0,0,0],
			lineWidth: 0.2,
		}
		});
		doc.save('relatorio_'+numero+'.pdf');
    }
}   
</script>