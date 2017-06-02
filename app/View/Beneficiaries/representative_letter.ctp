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
        $paginador = "PÁGINA 1  de  1 ";

        $tbl = <<<EOD
      <br>
<br><br>
<table  border="1" style=" font-size:8;"  cellpadding="4"  >
    <tbody>    
        <tr >
            <td rowspan="3" width="100px"  ><br><br><img src="../webroot/img/logo_izq.jpg" /></td>
            <td width="200px" align="left" rowspan="2" ><br><br>PROCEDIMIENTO: IMPLEMENTACIÓN DE PROYECTOS DE DESARROLLO RURAL –IPDR, A NIVEL NACIONAL</td>
            <td width="100px" align="center" >Código:<br> F1-PM-IPDR-01</td>
            <td width="100px" align="center"  rowspan="3"><br><br><img src="../webroot/img/derecho.png" /></td>
        </tr>

        <tr nobr="true" style="text-align:justify">
            
            
            <td align="center">FECHA EDICIÓN:<br> 21/09/2012</td>
        </tr>
        <tr nobr="true" style="text-align:justify">
            <td  >FORMATO ACTA DE SOCIALIZACIÓN Y VALIDACION DEL PROYECTO DE DESARROLLO RURAL </td>
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
$pdf->setHeaderMargin(5);
$pdf->SetMargins(20, 55, 20);



    $pdf->AddPage();
    $pdf->SetFont('Trebuchet', '', 12);
    $director = $evaluacion['Branch']['director'];
    $ciudad = $evaluacion['City']['name'];
    $departamento = $evaluacion['Departament']['name'];
   
    $pdf->SetFont('Trebuchet', '', 10);
    $V = new EnLetras();
    $mes = $V->obtenerMes(date("Y-m-d"));
    $nombres="";
    $nombrePredios="";
    $firmas="";
    $cont=0;
    foreach ($beneficiarios as $beneficiario) {
     $nombres.=$beneficiario['Beneficiary']['nombres']." ".$beneficiario['Beneficiary']['primer_apellido']." ".$beneficiario['Beneficiary']['segundo_apellido'].",";
     $firmas.="<br><br><br><br><br>". $beneficiario['Beneficiary']['nombres']." ".$beneficiario['Beneficiary']['primer_apellido']."<br>".$beneficiario['Beneficiary']['tipo_identificacion']." ".$beneficiario['Beneficiary']['numero_identificacion']; 
      
      
    }
    foreach ($predios as $predio) {
     $nombrePredios.=$predio['Property']['nombre'].", ";
        
    }
    $str="<span style=\"text-align:justify\"><br><br><br><br>Yo/Nosotros $nombres como representante(s) de las familias integrantes del proyecto de Desarrollo Rural, identificado con el código ".$evaluacion['Proyect']['codigo'].", ubicado en el Departamento ".$evaluacion['Departament']['name'].", Municipio ".$evaluacion['City']['name'].",  comunidad del predio $nombrePredios identificado(s) con cédula de ciudadanía como aparece al pie de la(s) firma(s), aspirantes a la cofinanciación de la Estrategia de Implementación de Proyectos de Desarrollo Rural, certifico(amos) que nos fué socializado y aprobamos el proyecto de desarrollo rural denominado \"".$evaluacion['InitialEvaluation']['nombre_proyecto']."\", para ".$evaluacion['InitialEvaluation']['beneficiarios']." familias, elaborado de forma conjunta con el formulador ".$evaluacion['InitialEvaluation']['nombre_aliado']." y el INCODER.</span><br><br>";
    $str.="<span style=\"text-align:justify\">Manifestamos que participamos activamente en el diagnóstico y  formulación concertada del proyecto mencionado y estamos de acuerdo con su contenido (sistemas productivos identificados, valor estimado y propuesta para la implementación del proyecto), por lo cual avalamos la presentación del mismo ante el INCODER para la posible aprobación de los recursos para su cofinanciación y nos comprometemos a aportar los  porcentajes  de  recursos propios  y mano de obra  establecidos en el proyecto.</span><br><br>";
    $str.="<span style=\"text-align:justify\">De la misma forma, la Dirección Territorial de INCODER ".$evaluacion['Departament']['name']." conoce el proyecto y avala la información socializada.</span> ";
    $str.="<table style=\"width:100%\"><tr><td><br><br><br>$firmas</td><td><br><br><br><br><br><br><br>".$evaluacion['Branch']['director']."<br>Director territorial ".$evaluacion['Departament']['name']."</td></tr>";
    $pdf->writeHTML($str, true, false, false, false, '');





$pdf->Output('CartaRepresentante.pdf', 'D');
?>
