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
<table  border="1" style="  width:100%"  cellpadding="4"  >
    <tbody>    
        <tr  style=" font-size:smaller;">
            <td rowspan="3" width="120px" align="center"  ><br><br><img style=" width:80px;height:70px" src="../webroot/img/logo_izq.png" /></td>
            <td width="340px" align="left"  ><br><br>Proceso: IMPLEMENTACIÓN DE PROYECTOS DE DESARROLLO RURAL A NIVEL NACIONAL</td>
            <td width="150px" align="center" >Código :  F8-PM-IPDR-01</td>
            <td width="110px" align="center"  rowspan="3"><br><br><img src="../webroot/img/derecho.png" /></td>
        </tr>

        <tr  style="text-align:justify;font-size:smaller;">
            
            <td align="center" rowspan="2">IMPLEMENTACIÓN PROYECTOS DE DESARROLLO RURAL - IPDR.</td>
            <td align="center">Fecha Edición: <br>21/08/2013</td>
        </tr>
        <tr  style="text-align:justify;font-size:smaller;">
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

$pdf = new MYPDF("L", 'mm', "LETTER", true, 'UTF-8', false);

$totalIncoder = 0;
$totalComunidad = 0;
$totalCertificada = 0;
$totalOtrasContrapartidas = 0;
$valor_total = 0;
$tipo = "";
$totalCantidadtmp = 0;
$totalUnitatmp = 0;
$incotmp = 0;
$comtmp = 0;
$totaltmp = 0;
$certftmp = 0;
$otratmp = 0;

$pdf->setPrintFooter(false);
$pdf->SetMargins(15, 50, 15);
$pdf->AddPage();
App::Import('model', 'Proyect');
$Proyect = new Proyect();
$Proyect->recursive = -1;

$proyecto = $Proyect->field("Proyect.codigo", array('Proyect.id' => $proyect_id));
$predios = $Proyect->Property->find("all", array('recursive' => -1, 'conditions' => array('Property.proyect_id' => $proyect_id), 'fields' => array('Property.nombre')));
App::Import('model', 'Resolution');
$Resolution = new Resolution();
$resolucion = $Resolution->find('first', array('recursive' => -1, 'conditions' => array('Resolution.proyect_id' => $proyect_id), 'order' => array('Resolution.id DESC')));
App::Import('model', 'InitialEvaluation');
$initialEvaluation = new InitialEvaluation();
$evaluacion = $initialEvaluation->find('first', array('recursive' => -1, 'conditions' => array('Follow.id' => $follow_id), 'order' => array('InitialEvaluation.id DESC'), 'fields' => array('InitialEvaluation.id', 'InitialEvaluation.valor_total', 'InitialEvaluation.monto_solicitado', 'InitialEvaluation.certificadas', 'InitialEvaluation.contraprtidas_propias'), 'joins' => array(array('table' => 'follows', 'type' => 'left', 'alias' => 'Follow', 'conditions' => 'InitialEvaluation.id=Follow.initial_evaluation_id'))));

$strPredios = "";
if (count($predios > 4)) {
    $size = 8;
} else {
    $size = 5;
}
foreach ($predios as $predio) {
    $strPredios.=$predio['Property']['nombre'] . ", ";
}
$strPredios = substr($strPredios, 0, -2);
$str = "<table cellpadding=\"3\"  border=\"1\"  style=\"width:920px;font-size:$size;  text-align:justify\">";
$str.="<tr><td style=\" width:20%\" >Código del proyecto:</td><td style=\" width:12%\">" . $proyecto . "</td> ";
$str.="<td style=\" width:20%\">Predio(s):</td><td>$strPredios</td></tr>";
$str.="<tr><td>Número de resolución:</td><td>" . $resolucion['Resolution']['numero'] . "</td>";
$str.="<td>Fecha dela resolución:</td><td>" . $resolucion['Resolution']['fecha'] . "</td></tr>";
$str.="<tr><td colspan=\"4\"><b>NÚMERO DE FAMILIAS BENEFICIARIAS</b></td></tr>";
if (isset($fam_campesinas))
    $str.="<tr><td colspan=\"2\">CAMPESINA</td><td colspan=\"2\">" . $fam_campesinas . "</td></tr>";
if (isset($fam_desplazadas))
    $str.="<tr><td colspan=\"2\">DESPLAZADA</td><td colspan=\"2\">" . $fam_desplazadas . "</td></tr>";
if (isset($fam_indigena))
    $str.="<tr><td colspan=\"2\">INDIGENA</td><td colspan=\"2\">" . $fam_indigena . "</td></tr>";
if (isset($fam_negritud))
    $str.="<tr><td colspan=\"2\">NEGRITUDES</td><td colspan=\"2\">" . $fam_negritud . "</td></tr>";
if (isset($fam_rom))
    $str.="<tr><td colspan=\"2\">ROM</td><td colspan=\"2\">" . $fam_rom . "</td></tr>";
if (isset($fam_mujer_cabeza))
    $str.="<tr><td colspan=\"2\">MUJER CABEZA DE FAMILIA</td><td colspan=\"2\">" . $fam_mujer_cabeza . "</td></tr>";
if (isset($total_familias))
    $str.="<tr><td colspan=\"2\">OTRO TIPO</td><td colspan=\"2\">" . $total_familias . "</td></tr>";

$str.="<tr><td colspan=\"4\" ><b>DISTRIBUCIÓN VALORES DE COFINANCIACIÓN Y CONTRAPARTIDAS</b></td></tr>";

$str.="<tr><td>Valor proyecto:</td><td> $ " . number_format($evaluacion['InitialEvaluation']['valor_total'], 0, ',', '.') . "</td>";
$str.="<td>Valor Cofinanciación INCODER:</td><td>$ " . number_format($evaluacion['InitialEvaluation']['monto_solicitado'], 0, ',', '.') . "</td></tr>";

$str.="<tr><td>Valor cofinanciación comunidad :</td><td>$ " . number_format($evaluacion['InitialEvaluation']['certificadas'] + $evaluacion['InitialEvaluation']['contraprtidas_propias'], 0, ',', '.') . "</td>";
$str.="<td>Valor cofinanciación contrapartidas certificadas :</td><td>$ " . number_format($evaluacion['InitialEvaluation']['certificadas'], 0, ',', '.') . "</td></tr>";

$str.="<tr><td>Valor cofinanciación otras contrapartidas  :</td><td>$ " . number_format($evaluacion['InitialEvaluation']['contraprtidas_propias'], 0, ',', '.') . "</td></tr>";
$str.="</table>";

$pdf->writeHTML($str, true, false, false, false, '');


$tbl = <<<EOD
<table style="width:100%" border="1" cellpadding="3">
            <thead>
                <tr style="font-size:9;text-align:center">
                    <th style="width:10%;">Actividades</th>
                    <th style="width:7%;" >Cantidad</th>
                    <th style="width:10%;"> Valor unitario en pesos</th>
                    <th style="width:10%;">Valor total</th>
                    <th style="width:10%;">Valor cofinanciación Incoder</th>
                    <th style="width:10%;">Valor cofinanciación comunidad</th>
                    <th style="width:10%;">Valor cofinanciación contrapartida certificada</th>
                    <th style="width:10%;">Valor cofinanciación otras contrapartidas</th>
                    <th style="width:25%;">Observaciones</th>
                </tr>
            </thead>            
EOD;

foreach ($Budgets as $Budget) {

    if ($tipo != "" and $tipo != $Budget['MonitoringActivity']['tipo']) {

        $tbl.="<tr style=\"font-size:9\" >
                    <td style=\"width:10%;\"><b>Subtotal $tipo</b></td>
                    <td style=\"width:7%;\"><b>" . number_format($totalCantidadtmp, 0, ',', '.') . "</b></td>
                    <td style=\"width:10%;\"><b>$ " . number_format($totalUnitatmp, 0, ',', '.') . "</b></td>
                    <td style=\"width:10%;\"><b>$ " . number_format($totaltmp, 0, ',', '.') . "</b></td>
                    <td style=\"width:10%;\"><b>$ " . number_format($incotmp, 0, ',', '.') . "</b></td>
                    <td style=\"width:10%;\"><b>$ " . number_format($comtmp, 0, ',', '.') . "</b></td>
                    <td style=\"width:10%;\"><b>$ " . number_format($certftmp, 0, ',', '.') . "</b></td>
                    <td style=\"width:10%;\"><b>$ " . number_format($otratmp, 0, ',', '.') . "</b></td>
                    <td style=\"width:25%;\"></td>
         </tr>";
        $totaltmp = 0;
        $incotmp = 0;
        $comtmp = 0;
        $certftmp = 0;
        $otratmp = 0;
        $totalCantidadtmp = 0;
        $totalUnitatmp = 0;
    }
    $tbl.="<tr style=\"font-size:9\" nobr=\"true\" >
                        <td style=\"width:10%;\">" . $Budget['MonitoringActivity']['nombre'] . "</td>
                        <td style=\"width:7%;\"> " . $Budget['Budget']['cantidad'] . "</td>
                        <td style=\"width:10%;\">" . number_format($Budget['Budget']['valor_unitario'], 0, ',', '.') . "</td>
                        <td style=\"width:10%;\">" . number_format($Budget['Budget']['valor_unitario'] * $Budget['Budget']['cantidad'], 0, ',', '.') . "</td>
                        <td style=\"width:10%;\">" . number_format($Budget['Budget']['cofinanciacion_incoder'], 0, ',', '.') . "</td>
                        <td style=\"width:10%;\">" . number_format($Budget['Budget']['cofinaciacion_comunidad'], 0, ',', '.') . " </td>
                        <td style=\"width:10%;\">" . number_format($Budget['Budget']['contapartida_certificada'], 0, ',', '.') . "</td>
                        <td style=\"width:10%;\">" . number_format($Budget['Budget']['otra_contrapartida'], 0, ',', '.') . "</td>
                        <td style=\"width:25%;\">" . $Budget['Budget']['observaciones'] . "</td>
                    </tr>";
    $totalUnitatmp+=$Budget['Budget']['valor_unitario'];
    $totaltmp+=$Budget['Budget']['valor_unitario'] * $Budget['Budget']['cantidad'];
    $valor_total+=($Budget['Budget']['valor_unitario'] * $Budget['Budget']['cantidad']);
    $incotmp+=$Budget['Budget']['cofinanciacion_incoder'];
    $totalIncoder+=$Budget['Budget']['cofinanciacion_incoder'];
    $comtmp+=$Budget['Budget']['cofinaciacion_comunidad'];
    $totalComunidad+=$Budget['Budget']['cofinaciacion_comunidad'];
    $certftmp+=$Budget['Budget']['contapartida_certificada'];
    $totalCertificada+=$Budget['Budget']['contapartida_certificada'];
    $otratmp+=$Budget['Budget']['otra_contrapartida'];
    $totalOtrasContrapartidas+=$Budget['Budget']['otra_contrapartida'];
    $totalCantidadtmp+=$Budget['Budget']['cantidad'];
    $tipo = $Budget['MonitoringActivity']['tipo'];
}
$tbl.="</table>";
$pdf->writeHTML($tbl, false, false, false, false, '');
$tbl = "<p nobr=\"true\">";

if ($tipo != "") {
    $tbl.="<table border=\"1\" style=\"width:100%\" cellpadding=\"3\">";
    $tbl.="<tr style=\"font-size:9\">
                    <td style=\"width:10%;\"><b>Subtotal $tipo</b></td>
                    <td style=\"width:7%;\"><b>" . number_format($totalCantidadtmp, 0, ',', '.') . "</b></td>
                    <td style=\"width:10%;\"><b>$ " . number_format($totalUnitatmp, 0, ',', '.') . "</b></td>
                    <td style=\"width:10%;\"><b>$ " . number_format($totaltmp, 0, ',', '.') . "</b></td>
                    <td style=\"width:10%;\"><b>$ " . number_format($incotmp, 0, ',', '.') . "</b></td>
                    <td style=\"width:10%;\"><b>$ " . number_format($comtmp, 0, ',', '.') . "</b></td>
                    <td style=\"width:10%;\"><b>$ " . number_format($certftmp, 0, ',', '.') . "</b></td>
                    <td style=\"width:10%;\"><b>$ " . number_format($otratmp, 0, ',', '.') . "</b></td>
                    <td style=\"width:25%;\"></td>
         </tr>";

    $tbl.="<tr style=\"font-size:9\" >
                    <td style=\"width:10%;\"><b>Total:</b></td>
                    <td style=\"width:7%;\"><b>" . number_format($valor_total, 0, ',', '.') . "</b></td>
                    <td style=\"width:10%;\"><b></b></td>
                    <td style=\"width:10%;\"><b>$ " . number_format($valor_total, 0, ',', '.') . "</b></td>
                    <td style=\"width:10%;\"><b>$ " . number_format($totalIncoder, 0, ',', '.') . "</b></td>
                    <td style=\"width:10%;\"><b>$ " . number_format($totalComunidad, 0, ',', '.') . "</b></td>
                    <td style=\"width:10%;\"><b>$ " . number_format($totalCertificada, 0, ',', '.') . "</b></td>
                    <td style=\"width:10%;\"><b>$ " . number_format($totalOtrasContrapartidas, 0, ',', '.') . "</b></td>
                    <td style=\"width:25%;\"></td>

         </tr>";
    $tbl.="</table>";
}

if ($totalIncoder > $evaluacion['InitialEvaluation']['monto_solicitado'] * 1000) {
    $tbl.="<br><h1 style='color:red;'>El valor de la suma del cofinanciación Incoder ($totalIncoder) es mayor que el de la resolución (" . $evaluacion['InitialEvaluation']['monto_solicitado'] . ")</h1>";
}
$tbl.= "<br><table border=\"0\" style=\"width:90%;font-size:smaller;  text-alige:center;border 0px; \">";
$tbl.="<tr><td><br><br>_______________________<br>Representente de la comunidad<br>Nombre:<br>C.C: </td><td><br><br><br>_______________________<br>Beneficiario<br>Nombre:<br>C.C </td></tr> ";
$tbl.="<tr><td><br><br>_______________________<br>Representante  INCODER<br>Nombre:<br>C.C: </td><td><br><br><br>_______________________<br><br>Nombre:<br>C.C </td></tr> ";
$tbl.="</table>";
$tbl.="</p>";
$pdf->writeHTML($tbl, true, false, false, false, '');
$pdf->Output('presupuesto_' . $proyecto . '.pdf', 'I');
?>