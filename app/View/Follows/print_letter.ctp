<?php

App::import('Vendor', 'tcpdf/tcpdf');
//App::import('Vendor', 'tcpdf/config/lang/eng.php');
App::import('Vendor', 'EnLetras', array('file' => 'EnLetras.class.php'));

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logotrebuchet

        $pagina = $this->getAliasNumPage();
        $total_painas = $this->getAliasNbPages();
        $paginador = "PÁGINA $pagina  de  $total_painas";

        $tbl = <<<EOD
      <br>
<br><br>
<table  border="1" style=" font-size:8; width:100%"  cellpadding="4"  >
    <tbody>    
        <tr >
            <td rowspan="3" width="100px"  ><br><br><img style=" width:80px;height:70px"  src="../webroot/img/logo_izq.png" /></td>
            <td width="200px" align="left"  ><br><br>Proceso: IMPLEMENTACION DE PROYECTOS DE DESARROLLO RURAL A NIVEL NACIONAL</td>
            <td width="100px" align="center" >Código :  F9-PM-IPDR-01</td>
            <td width="120px" align="center"  rowspan="3"><br><br><img src="../webroot/img/derecho.png" /></td>
        </tr>

        <tr  style="text-align:justify">
            
            <td align="center" rowspan="2">FORMATO: CRONOGRAMA DE PLAN DE COMPRAS</td>
            <td align="center">Fecha Edición: <br>21/08/2013</td>
        </tr>
        <tr  style="text-align:justify">
            <td align="center">$paginador</td>

        </tr>
        
       
    </tbody>
</table>
EOD;

        $this->writeHTML($tbl, true, false, false, false, '');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

}

$pdf = new MYPDF("P", 'mm', "LETTER", true, 'UTF-8', false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(15, 55, 15);
$pdf->AddPage();
App::Import('model', 'Proyect');
$Proyect = new Proyect();
$Proyect->recursive = -1;
App::Import('model', 'CommitteeBudget');
$CommitteeBudget = new CommitteeBudget();
$CommitteeBudget->recursive = -1;

$proyecto = $Proyect->field("Proyect.codigo", array('Proyect.id' => $proyect_id));
$predios = $Proyect->Property->find("all", array('recursive' => -1, 'conditions' => array('Property.proyect_id' => $proyect_id), 'fields' => array('Property.nombre')));
$strPredios = "";
foreach ($predios as $predio) {
    $strPredios.=$predio['Property']['nombre'] . " ";
}
$str = "<span style=\"text-align:center;font-size:smaller;\">CRONOGRAMA DE DESEMBOLSOS PROYECTO PRESUPUESTO GENERAL MENSUALIZADO</span><br><br>";
$str.="<table border=\"1\" style=\"width:50%;font-size:smaller;  text-alige:center\"><tr><td>CÓDIGO DEL PROYECTO:</td><td>" . $proyecto . "</td></tr> <tr><td>NOMBRE DEL PREDIO:</td><td>$strPredios</td></tr></table>";
$pdf->writeHTML($str, true, false, false, false, '');

App::Import('model', 'Budget');
$Budget = new Budget();
$numerocomites = count($comites);
$cab = "<table border=\"1\"  cellpadding=\"4\" style=\"font-size:small\">";
$cab.="<thead><tr style=\"text-align:center\" ><th rowspan=\"2\">RUBROS</th><th colspan=\"$numerocomites\">Comités</th><th rowspan=\"2\">TOTAL</th></tr><tr>";
foreach ($comites as $comite) {
    $cab.="<th>" . $comite['Committee']['fecha'] . "</th>";
}

$cab.="</tr></thead>";
$str = "";
$total = 0;
$subTotal = 0;
$tipo = "";

$Budgets = $Budget->find('all', array('recursive' => 0, 'order' => array('MonitoringActivity.tipo ASC'), 'conditions' => array('Budget.follow_id' => $follow_id), 'fields' => array('MonitoringActivity.tipo', 'MonitoringActivity.nombre', 'Budget.id')));


foreach ($Budgets as $Budget) {
    if ($tipo != $Budget['MonitoringActivity']['tipo'] and $tipo != "") {
        $str.="<tr><td><b>Subtotal " . $tipo . ":</b></td>";
        foreach ($comites as $comite) {
            $str.="<td></td>";
        }
        $str.="<td><b>$ " . number_format($subTotal, 0, ',', '.') . "</b></td></tr>";
        $subTotal = 0;
    }

    $str.="<tr style=\"font-size:small\"><td>" . $Budget['MonitoringActivity']['nombre'] . "</td>";
    $totalXrubro = 0;
    foreach ($comites as $comite) {

        $gastoComite = $CommitteeBudget->find('first', array('conditions' => array('CommitteeBudget.budget_id' => $Budget['Budget']['id'], 'CommitteeBudget.committee_id' => $comite['Committee']['id'])));
        $total+=$gastoComite['CommitteeBudget']['valor'];
        $subTotal+=$gastoComite['CommitteeBudget']['valor'];
        $totalXrubro+=$gastoComite['CommitteeBudget']['valor'];
        $str.="<td> $ " . number_format($gastoComite['CommitteeBudget']['valor'], 0, ',', '.') . "</td>";
    }

    $str.="<td>$ " . number_format($totalXrubro, 0, ',', '.') . "</td></tr>";
    $tipo = $Budget['MonitoringActivity']['tipo'];
}




if ($tipo != "") {
    $str.="<tr><td><b>Subtotal " . $Budget['MonitoringActivity']['tipo'] . ":</b></td>";
    foreach ($comites as $comite) {
        $str.="<td></td>";
    }
    $str.="<td><b>$ " . number_format($subTotal, 0, ',', '.') . "</b></td></tr>";
}
$str.="<tr><td>TOTAL:</td>";
foreach ($comites as $comite) {
    $str.="<td></td>";
}
$str.="<td>$ " . number_format($total, 0, ',', '.') . "</td></tr>";
$str.="</table>";



//echo $cab.$str;
$pdf->writeHTML($cab . $str, true, false, false, false, '');
$pdf->Output('plan_compras_' . $proyecto . '.pdf', 'D');
?>
