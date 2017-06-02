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
            <td width="435px" align="left"  ><br><br>Proceso: IMPLEMENTACIÓN DE PROYECTOS DE DESARROLLO RURAL A NIVEL NACIONAL</td>
            <td width="190px" align="center" >Código :  F8-PM-IPDR-01</td>
            <td width="150px" align="center"  rowspan="3"><br><br><img src="../webroot/img/derecho.png" /></td>
        </tr>

        <tr  style="text-align:justify;font-size:smaller;">
            
            <td align="center" rowspan="2">FORMATO: Plan de inversión</td>
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

$pdf = new MYPDF("L", 'mm', "LEGAL", true, 'UTF-8', false);


$valor_total = 0;
$tipo = "";
$totaltmp = 0;
$mes1tmp = 0;
$mes1tot = 0;
$mes2tot = 0;
$mes2tmp = 0;
$mes3tot = 0;
$mes3tmp = 0;
$mes4tot = 0;
$mes4tmp = 0;
$mes4tot = 0;
$mes5tmp = 0;
$mes5tot = 0;
$mes6tmp = 0;
$mes6tot = 0;
$mes7tmp = 0;
$mes7tot = 0;
$mes8tmp = 0;
$mes8tot = 0;
$mes9tmp = 0;
$mes9tot = 0;
$mes10tmp = 0;
$mes10tot = 0;
$mes11tmp = 0;
$mes11tot = 0;
$mes12tmp = 0;
$mes12tot = 0;
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
if(count($predios>4)){
    $size=8;
}else{
    $size=5;
}  
$strPredios="";
foreach ($predios as $predio) {
    $strPredios.=$predio['Property']['nombre'].", ";
}
$strPredios=  substr($strPredios,0,-2 );
$str="<span style=\"text-align:center;font-size:smaller;\">CRONOGRAMA DE DESEMBOLSOS PROYECTO   PRESUPUESTO GENERAL MENSUALIZADO ($ .000)</span><br><br>";
$str.="<table cellpadding=\"5\" border=\"1\" style=\"width:100%;font-size:$size;  text-alige:center\"><tr><td style=\"width:10%\">CÓDIGO DEL PROYECTO:</td><td>".$proyecto."</td></tr> <tr><td >NOMBRE DEL PREDIO:</td><td>$strPredios</td></tr></table>";
$pdf->writeHTML($str, true, false, false, false, '');
$tbl = <<<EOD
<table style="width:100%" border="1" cellpadding="3">
            <thead>
                <tr style="font-size:7;text-align:center">

                    
                    <th style="width:8%;text-align:center">Actividades</th>
                    <th style="width:6%;text-align:center">Valor total</th>
                    <th style="width:6%;text-align:center">Mes 1</th>
                    <th style="width:6%;text-align:center">Mes 2</th>
                    <th style="width:6%;text-align:center">Mes 3</th>
                    <th style="width:6%;text-align:center">Mes 4</th>
                    <th style="width:6%;text-align:center">Mes 5</th>
                    <th style="width:6%;text-align:center">Mes 6</th>
                    <th style="width:6%;text-align:center">Mes 7</th>
                    <th style="width:6%;text-align:center">Mes 8</th>
                    <th style="width:6%;text-align:center">Mes 9</th>
                    <th style="width:6%;text-align:center">Mes 10</th>
                    <th style="width:6%;text-align:center">Mes 11</th>
                    <th style="width:6%;text-align:center">Mes 12</th>
                    <th style="width:6%;text-align:center">Total rubros</th>
                    <th style="width:10%;">Observaciones</th>
                </tr>
            </thead>
           
            
EOD;

foreach ($Budgets as $Budget) {

    if ($tipo != "" and $tipo != $Budget['MonitoringActivity']['tipo']) {

        $tbl.="<tr style=\"font-size:7\" nobr=\"true\">
                    <td><b>Subtotal $tipo</b></td>
                    
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($totaltmp, 0, ',', '.') . "</b>
                    </td>
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes1tmp, 0, ',', '.') . "</b>
                    </td>
                    
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes2tmp, 0, ',', '.') . "</b>
                    </td>
                    
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes3tmp, 0, ',', '.') . "</b>
                    </td>
                    
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes4tmp, 0, ',', '.') . "</b>
                    </td>
                    
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes5tmp, 0, ',', '.') . "</b>
                    </td>
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes6tmp, 0, ',', '.') . "</b>
                    </td>
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes7tmp, 0, ',', '.') . "</b>
                    </td>
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes8tmp, 0, ',', '.') . "</b>
                    </td>
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes9tmp, 0, ',', '.') . "</b>
                    </td>
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes10tmp, 0, ',', '.') . "</b>
                    </td>
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes11tmp, 0, ',', '.') . "</b>
                    </td>
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes12tmp, 0, ',', '.') . "</b>
                    </td>
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($sumatmp, 0, ',', '.') . "</b>
                    </td>
                    
                    <td style=\"width:10%;\"></td>

         </tr>";
        $totaltmp = 0;
        $mes1tmp = 0;
        $mes2tmp = 0;
        $mes3tmp = 0;
        $mes4tmp = 0;
        $mes5tmp = 0;
        $mes6tmp = 0;
        $mes7tmp = 0;
        $mes8tmp = 0;
        $mes9tmp = 0;
        $mes10tmp = 0;
        $mes11tmp = 0;
        $mes12tmp = 0;
        $sumatmp = 0;
    }
    $tbl.="<tr style=\"font-size:7\" nobr=\"true\">
                        <td style=\"width:8%;text-align:justify\">" . $Budget['MonitoringActivity']['nombre'] . "</td>
                        <td style=\"width:6%;text-align:center\">" . number_format($Budget['Budget']['valor_unitario'] * $Budget['Budget']['cantidad'], 0, ',', '.') . "</td>
                        <td style=\"width:6%;text-align:center\">" . number_format($Budget['Budget']['mes1'], 0, ',', '.') . "</td>
                        <td style=\"width:6%;text-align:center\">" . number_format($Budget['Budget']['mes2'], 0, ',', '.') . " </td>
                        <td style=\"width:6%;text-align:center\">" . number_format($Budget['Budget']['mes3'], 0, ',', '.') . "</td>
                        <td style=\"width:6%;text-align:center\">" . number_format($Budget['Budget']['mes4'], 0, ',', '.') . "</td>
                        <td style=\"width:6%;text-align:center\">" . number_format($Budget['Budget']['mes5'], 0, ',', '.') . "</td>
                        <td style=\"width:6%;text-align:center\">" . number_format($Budget['Budget']['mes6'], 0, ',', '.') . "</td>
                        <td style=\"width:6%;text-align:center\">" . number_format($Budget['Budget']['mes7'], 0, ',', '.') . "</td>
                        <td style=\"width:6%;text-align:center\">" . number_format($Budget['Budget']['mes8'], 0, ',', '.') . "</td>
                        <td style=\"width:6%;text-align:center\">" . number_format($Budget['Budget']['mes9'], 0, ',', '.') . "</td>
                        <td style=\"width:6%;text-align:center\">" . number_format($Budget['Budget']['mes10'], 0, ',', '.') . "</td>
                        <td style=\"width:6%;text-align:center\">" . number_format($Budget['Budget']['mes11'], 0, ',', '.') . "</td>
                        <td style=\"width:6%;text-align:center\">" . number_format($Budget['Budget']['mes12'], 0, ',', '.') . "</td>
                        <td style=\"width:6%;text-align:center\">" . number_format($Budget['Budget']['mes1'] + $Budget['Budget']['mes2'] + $Budget['Budget']['mes3'] + $Budget['Budget']['mes4'] + $Budget['Budget']['mes5'] + $Budget['Budget']['mes6']+ $Budget['Budget']['mes7']+ $Budget['Budget']['mes8']+ $Budget['Budget']['mes9']+ $Budget['Budget']['mes10']+ $Budget['Budget']['mes11']+ $Budget['Budget']['mes12'], 0, ',', '.') . "</td>
                        <td style=\"width:10%;\">" . $Budget['Budget']['observaciones_mes'] . "</td>
                    </tr>";
    $sumatmp += ($Budget['Budget']['mes1'] + $Budget['Budget']['mes2'] + $Budget['Budget']['mes3'] + $Budget['Budget']['mes4'] + $Budget['Budget']['mes5'] + $Budget['Budget']['mes6']+ $Budget['Budget']['mes7']+ $Budget['Budget']['mes8']+ $Budget['Budget']['mes9']+ $Budget['Budget']['mes10']+ $Budget['Budget']['mes11']+ $Budget['Budget']['mes12']);
    $suma_total+=($Budget['Budget']['mes1'] + $Budget['Budget']['mes2'] + $Budget['Budget']['mes3'] + $Budget['Budget']['mes4'] + $Budget['Budget']['mes5'] + $Budget['Budget']['mes6']+ $Budget['Budget']['mes7']+ $Budget['Budget']['mes8']+ $Budget['Budget']['mes9']+ $Budget['Budget']['mes10']+ $Budget['Budget']['mes11']+ $Budget['Budget']['mes12']);

    $totaltmp+=($Budget['Budget']['valor_unitario'] * $Budget['Budget']['cantidad'] );
    $valor_total+=$Budget['Budget']['valor_unitario'] * $Budget['Budget']['cantidad'];
    $mes1tmp+=$Budget['Budget']['mes1'];
    $mes1tot+=$Budget['Budget']['mes1'];
    $mes2tmp+=$Budget['Budget']['mes2'];
    $mes2tot+=$Budget['Budget']['mes2'];
    $mes3tmp+=$Budget['Budget']['mes3'];
    $mes3tot+=$Budget['Budget']['mes3'];
    $mes4tmp+=$Budget['Budget']['mes4'];
    $mes4tot+=$Budget['Budget']['mes4'];
    $mes5tmp+=$Budget['Budget']['mes5'];
    $mes5tot+=$Budget['Budget']['mes5'];
    $mes6tmp+=$Budget['Budget']['mes6'];
    $mes6tot+=$Budget['Budget']['mes6'];
    $mes7tmp+=$Budget['Budget']['mes7'];
    $mes7tot+=$Budget['Budget']['mes7'];
    $mes8tmp+=$Budget['Budget']['mes8'];
    $mes8tot+=$Budget['Budget']['mes8'];
    $mes9tmp+=$Budget['Budget']['mes9'];
    $mes9tot+=$Budget['Budget']['mes9'];
    $mes10tmp+=$Budget['Budget']['mes10'];
    $mes10tot+=$Budget['Budget']['mes10'];
    $mes11tmp+=$Budget['Budget']['mes11'];
    $mes11tot+=$Budget['Budget']['mes11'];
    $mes12tmp+=$Budget['Budget']['mes12'];
    $mes12tot+=$Budget['Budget']['mes12'];
    $tipo = $Budget['MonitoringActivity']['tipo'];
}

if ($tipo != "") {
    $tbl.="<tr style=\"font-size:7\" nobr=\"true\">
                    <td><b>Subtotal $tipo</b></td>
                    
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($totaltmp, 0, ',', '.') . "</b>
                    </td>
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes1tmp, 0, ',', '.') . "</b>
                    </td>
                    
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes2tmp, 0, ',', '.') . "</b>
                    </td>
                    
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes3tmp, 0, ',', '.') . "</b>
                    </td>
                    
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes4tmp, 0, ',', '.') . "</b>
                    </td>
                    
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes5tmp, 0, ',', '.') . "</b>
                    </td>
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes6tmp, 0, ',', '.') . "</b>
                    </td>
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes7tmp, 0, ',', '.') . "</b>
                    </td>
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes8tmp, 0, ',', '.') . "</b>
                    </td>
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes9tmp, 0, ',', '.') . "</b>
                    </td>
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes10tmp, 0, ',', '.') . "</b>
                    </td>
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes11tmp, 0, ',', '.') . "</b>
                    </td>
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($mes12tmp, 0, ',', '.') . "</b>
                    </td>
                    <td style=\"width:6%;text-align:center\">
                        <b>$ " . number_format($sumatmp, 0, ',', '.') . "</b>
                    </td>
                    
                    <td style=\"width:10%;\"></td>

         </tr>";

    $tbl.="<tr style=\"font-size:7;text-align:center\" nobr=\"true\" >
                    <td><b>Total:</b></td>
                    <td>
                        <b>$ " . number_format($valor_total, 0, ',', '.') . "</b>
                    </td>
                    <td>
                        <b>$ " . number_format($mes1tot, 0, ',', '.') . "</b>
                    </td>
                    
                    <td>
                        <b>$ " . number_format($mes2tot, 0, ',', '.') . "</b>
                    </td>
                    
                    <td>
                        <b>$ " . number_format($mes3tot, 0, ',', '.') . "</b>
                    </td>
                    
                    <td>
                        <b>$ " . number_format($mes4tot, 0, ',', '.') . "</b>
                    </td>
                    
                    <td>
                        <b>$ " . number_format($mes5tot, 0, ',', '.') . "</b>
                    </td>
                    
                    <td>
                        <b>$ " . number_format($mes6tot, 0, ',', '.') . "</b>
                    </td>
                    <td>
                        <b>$ " . number_format($mes7tot, 0, ',', '.') . "</b>
                    </td>
                    <td>
                        <b>$ " . number_format($mes8tot, 0, ',', '.') . "</b>
                    </td>
                    <td>
                        <b>$ " . number_format($mes9tot, 0, ',', '.') . "</b>
                    </td>
                    <td>
                        <b>$ " . number_format($mes10tot, 0, ',', '.') . "</b>
                    </td>
                    <td>
                        <b>$ " . number_format($mes11tot, 0, ',', '.') . "</b>
                    </td>
                    <td>
                        <b>$ " . number_format($mes12tot, 0, ',', '.') . "</b>
                    </td>
                    <td>
                        <b>$ " . number_format($suma_total, 0, ',', '.') . "</b>
                    </td>
                    
                    <td style=\"width:10%;\"></td>

         </tr>";
}
$tbl.="</table>";

$pdf->writeHTML($tbl, true, false, false, false, '');
$pdf->Output('calendario.pdf', 'I');
?>
