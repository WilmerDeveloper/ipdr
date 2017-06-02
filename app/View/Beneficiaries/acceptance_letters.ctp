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
            <td  >Formato Acta de aceptación de ingreso al programa Implementación Proyectos de Desarrollo Rural </td>
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


foreach ($beneficiarios as $beneficiario) {
    $pdf->AddPage();
    $pdf->SetFont('Trebuchet', '', 12);
    $director = $beneficiario['Branch']['director'];
    $predio = $beneficiario['Property']['nombre'];
    $ciudad = $beneficiario['City']['name'];
    $departamento = $beneficiario['Departament']['name'];
    $nombre = $beneficiario['Beneficiary']['nombres'] . " " . $beneficiario['Beneficiary']['primer_apellido'] . " " . $beneficiario['Beneficiary']['segundo_apellido'];
    $identificación = $beneficiario['Beneficiary']['tipo_identificacion'] . " número " . $beneficiario['Beneficiary']['numero_identificacion'];
    $str = '<span style="text-align:center"><b>ACTA DE ACEPTACIÓN DE INGRESO A LA ESTRATEGIA DE IMPLEMENTACIÓN DE PROYECTOS DE DESARROLLO RURAL</b></span> <br><br><br><br><br>';
    $pdf->writeHTML($str, true, false, false, false, '');
    $pdf->SetFont('Trebuchet', '', 10);
    $V = new EnLetras();
    $mes = $V->obtenerMes(date("Y-m-d"));
    $str="<span style=\"text-align:left\">$mes</span><br><br>";
    $str.= "<span style=\"text-align:justify\">Yo $nombre , identificado(a) con $identificación como aparece al pie de mi firma, certifico que me ha sido socializada la metodología para la implementación de proyectos de desarrollo rural, por lo cual estoy de acuerdo y me comprometo a cumplir con lo establecido en la Estrategia.</span><br><br>";
    $str.="<span style=\"text-align:justify\">Certifico que estoy situado en el predio denominado $predio ubicado en el Municipio $ciudad del Departamento $departamento y participaré activamente en el desarrollo de todas las actividades concernientes a la Estrategia de  Implementación de Proyectos de Desarrollo Rural tanto en las etapas previas a la Formulación, Diagnóstico, Formulación e Implementación con el Acompañamiento Integral respectivo para cada iniciativa productiva.</span><br><br><br>";
    $str.="<span style=\"text-align:left\">FIRMA: __________________________________</span><br><br>";
    $str.="<span style=\"text-align:left\">Cédula #    _____________________________________________</span><br><br>";
    $str.="<span style=\"text-align:left\">V°B°     _____________________________________________</span><br><br><br><br><br><br><br>";
    $str.="<span style=\"text-align:left\"><b>$director</b><br>Director territorial de $departamento</span><br><br>";

    $pdf->writeHTML($str, true, false, false, false, '');
}




$pdf->Output('CartasAceptacion.pdf', 'D');
?>
