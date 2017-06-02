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


$valor_total = 0;
$tipo = "";
$totaltmp = 0;
$comite1tmp = 0;
$comite1tot = 0;
$comite2tot = 0;
$comite2tmp = 0;
$comite3tot = 0;
$comite3tmp = 0;
$comite4tot = 0;
$comite4tmp = 0;
$comite4tot = 0;
$comite5tmp = 0;
$comite5tot = 0;
$comite6tmp = 0;
$comite6tot = 0;
$sumatmp = 0;
$suma_total = 0;







$pdf->setPrintFooter(false);
$pdf->SetMargins(15, 55, 15);
$pdf->AddPage();
App::Import('model','Proyect');
$Proyect= new Proyect();
$Proyect->recursive=-1;

$proyecto=$Proyect->field("Proyect.codigo", array('Proyect.id'=>$proyect_id));
$predios=$Proyect->Property->find("all", array('recursive'=>-1, 'conditions'=> array('Property.proyect_id'=>$proyect_id),'fields'=>array('Property.nombre')  ));
 $strPredios="";
foreach ($predios as $predio) {
    $strPredios.=$predio['Property']['nombre']." ";
}
$str="<span style=\"text-align:center;font-size:smaller;\">CRONOGRAMA DE DESEMBOLSOS PROYECTO   PRESUPUESTO GENERAL MENSUALIZADO ($ .000)</span><br><br>";
$str.="<table border=\"1\" style=\"width:50%;font-size:smaller;  text-alige:center\"><tr><td>CÓDIGO DEL PROYECTO:</td><td>".$proyecto."</td></tr> <tr><td>NOMBRE DEL PREDIO:</td><td>$strPredios</td></tr></table>";
$pdf->writeHTML($str, true, false, false, false, '');

$tbl="";
$fecha1="";
$fecha2="";
$fecha3="";
$fecha4="";
foreach ($Budgets as $Budget) {

    if ($tipo != "" and $tipo != $Budget['MonitoringActivity']['tipo']) {

        $tbl.="<tr style=\"font-size:9\" nobr=\"true\">
                    <td><b>Subtotal $tipo</b></td>
                    
                    <td style=\"width:16%;text-align:left\"><b>" . number_format($comite1tmp, 0, ',', '.') . "</b></td>
                    <td style=\"width:16%;text-align:left\"><b>" . number_format($comite2tmp, 0, ',', '.') . "</b></td>
                    <td style=\"width:16%;text-align:left\"><b>" . number_format($comite3tmp, 0, ',', '.') . "</b></td>
                    <td style=\"width:16%;text-align:left\"><b>" . number_format($comite4tmp, 0, ',', '.') . "</b></td>
                    <td style=\"width:16%;text-align:left\"><b>" . number_format($sumatmp, 0, ',', '.') . "</b></td>
         </tr>";
        $totaltmp = 0;
        $comite1tmp = 0;
        $comite2tmp = 0;
        $comite3tmp = 0;
        $comite4tmp = 0;
        $sumatmp = 0;
    }
    $tbl.="<tr style=\"font-size:9\" nobr=\"true\">
                        <td style=\"width:16%;text-align:left\">" . $Budget['MonitoringActivity']['nombre'] . "</td>
                        <td style=\"width:16%;text-align:left\">" . number_format($Budget['Budget']['valor_comite1'], 0, ',', '.') . "</td>
                        <td style=\"width:16%;text-align:left\">" . number_format($Budget['Budget']['valor_comite2'], 0, ',', '.') . " </td>
                        <td style=\"width:16%;text-align:left\">" . number_format($Budget['Budget']['valor_comite3'], 0, ',', '.') . "</td>
                        <td style=\"width:16%;text-align:left\">" . number_format($Budget['Budget']['valor_comite4'], 0, ',', '.') . "</td>
                        <td style=\"width:16%;text-align:left\">" . number_format($Budget['Budget']['valor_comite1'] + $Budget['Budget']['valor_comite2'] + $Budget['Budget']['valor_comite3'] + $Budget['Budget']['valor_comite4'] , 0, ',', '.') . "</td>
            </tr>";
    $sumatmp += ($Budget['Budget']['valor_comite1'] + $Budget['Budget']['valor_comite2'] + $Budget['Budget']['valor_comite3'] + $Budget['Budget']['valor_comite4']);
    $suma_total+=($Budget['Budget']['valor_comite1'] + $Budget['Budget']['valor_comite2'] + $Budget['Budget']['valor_comite3'] + $Budget['Budget']['valor_comite4']);

    $comite1tmp+=$Budget['Budget']['valor_comite1'];
    $comite1tot+=$Budget['Budget']['valor_comite1'];
    $comite2tmp+=$Budget['Budget']['valor_comite2'];
    $comite2tot+=$Budget['Budget']['valor_comite2'];
    $comite3tmp+=$Budget['Budget']['valor_comite3'];
    $comite3tot+=$Budget['Budget']['valor_comite3'];
    $comite4tmp+=$Budget['Budget']['valor_comite4'];
    $comite4tot+=$Budget['Budget']['valor_comite4'];
    $fecha1=$Budget['Budget']['fecha_comite1'];
    $fecha2=$Budget['Budget']['fecha_comite2'];
    $fecha3=$Budget['Budget']['fecha_comite3'];
    $fecha4=$Budget['Budget']['fecha_comite4'];
    $tipo = $Budget['MonitoringActivity']['tipo'];
}

if ($tipo != "") {
    $tbl.="<tr style=\"font-size:9\" nobr=\"true\">
                    <td><b>Subtotal $tipo</b></td>
                    
                    <td style=\"width:16%;text-align:left\"><b>" . number_format($comite1tmp, 0, ',', '.') . "</b></td>
                    <td style=\"width:16%;text-align:left\"><b>" . number_format($comite2tmp, 0, ',', '.') . "</b></td>
                    <td style=\"width:16%;text-align:left\"><b>" . number_format($comite3tmp, 0, ',', '.') . "</b></td>
                    <td style=\"width:16%;text-align:left\"><b>" . number_format($comite4tmp, 0, ',', '.') . "</b></td>
                    <td style=\"width:16%;text-align:left\"><b>" . number_format($sumatmp, 0, ',', '.') . "</b></td>
         </tr>";

    $tbl.="<tr style=\"font-size:9\" nobr=\"true\">
                    <td><b>Total:</b></td>
                    <td><b>" . number_format($comite1tot, 0, ',', '.') . "</b></td>
                    <td><b>" . number_format($comite2tot, 0, ',', '.') . "</b> </td>
                    <td><b>" . number_format($comite3tot, 0, ',', '.') . "</b></td>
                    <td><b>" . number_format($comite4tot, 0, ',', '.') . "</b></td>
                    <td><b>" . number_format($suma_total, 0, ',', '.') . "</b> </td>
         </tr>";
}
$tbl.="</table>";

$encabezado = <<<EOD
<table style="width:100%" border="1">
            <thead>
                <tr style="font-size:9;text-align:center">

                    
                    <th style="width:16%;text-align:center">Rubros</th>
                    <th style="width:16%;text-align:center">Comité 1 ($fecha1)</th>
                    <th style="width:16%;text-align:center">Comité 2 ($fecha1)</th>
                    <th style="width:16%;text-align:center">Comité 3 ($fecha1)</th>
                    <th style="width:16%;text-align:center">Comité 4 ($fecha1)</th>
                    <th style="width:16%;text-align:center">Total rubros</th>
                </tr>
            </thead>
           
            
EOD;


//echo $tbl;
$pdf->writeHTML($encabezado.$tbl, true, false, false, false, '');
$pdf->Output('plan_compras.pdf', 'D');
?>
