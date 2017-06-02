<?php

App::import('Vendor', 'tcpdf/tcpdf');
App::import('Vendor', 'EnLetras', array('file' => 'EnLetras.class.php'));

class MYPDF extends TCPDF {

    public function Header() {
        $pagina = $this->getAliasNumPage();
        $total_painas = $this->getAliasNbPages();
        $paginador = "PÁGINA $pagina  de  $total_painas";

         $tbl = <<<EOD
      <br>
<br><br>
<table border="1" style=" width:100%" cellpadding="4">
    <tbody>    
        <tr style=" font-size:smaller;">
            <td rowspan="3" width="120px" align="center"  ><br><br><img style=" width:80px;height:90px" src="../webroot/img/logo_izq.jpg" /></td>
            <td width="340px" align="center" >MACROPROCESO: ORDENAMIENTO SOCIAL Y ACCESO A TIERRAS RURALES</td>
            <td width="150px" align="center" >CODIGO: <br> F12-OA-OS-02</td>
            <td width="110px" align="center"  rowspan="3"><br><br><img src="../webroot/img/derecho.png" /></td>
        </tr>
        <tr style="text-align:justify;font-size:smaller;">
            <td align="left">PROCESO: Otorgamiento de Subsidios y Desarrollo Productivo</td>
            <td align="center">FECHA EDICIÓN: <br>05/03/2015</td>
        </tr>
        <tr style="text-align:justify;font-size:smaller;">
            <td align="left">FORMATO: Lista de asistencia Beneficiarios</td>
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
$pdf->setPrintFooter(false);
$pdf->SetMargins(15, 55, 15);
$pdf->AddPage();
$cnt=1;
$br="<br>";
$tabla="<div style=\"font-size:9\">";
$tabla.="<span>FECHA: </span>$br$br";
$tabla.="<span>TEMA:____________________________________________________________________________________________________________________________________</span>$br$br";
$tabla.="<span>__________________________________________________________________________________________________________________________________________</span>$br$br";
$tabla.="<span>FECHA EVENTO:__________________________________MUNICIPIO Y DEPARTAMENTO:______________________________________________________________</span>$br$br";
$tabla.="<span>RESPONSABLE(S):_________________________________________________________________________________________________________________________</span>$br$br";
$tabla.="<span>OBJETIVO:________________________________________________________________________________________________________________________________</span>$br$br";
$tabla.="<span>__________________________________________________________________________________________________________________________________________</span>$br$br";
$tabla.="</div>";

$tabla.="<table cellpadding=\"10\" border=\"1\" style=\"font-size:9\">";
$tabla.=" <thead><tr style=\"text-align:center;font-size:9\"><th style=\"width:5%\">No</th><th style=\"width:25%\" >NOMBRES  Y APELLIDOS</th><th style=\"width:10%\" >No.CÉDULA</th><th style=\"width:12%\">DIRECCIÓN DE NOTIFICACIÓN</th><th style=\"width:22%\">No. TELEFÓNICO</th><th>CORREO ELECTRÓNICO</th><th>FIRMA</th></tr> </thead>";
$tabla.="<tbody >";
foreach ($Beneficiaries as $Beneficiary) {
    $tabla.="<tr nobr=\"true\" >"
            . "<td style=\"width:5%;text-align:center\">$cnt</td>"
            . "<td style=\"width:25%\">".$Beneficiary['Beneficiary']['nombres']." ".$Beneficiary['Beneficiary']['primer_apellido']."</td>"
            . "<td style=\"width:10%\">".$Beneficiary['Beneficiary']['numero_identificacion']."</td>"
            . "<td style=\"width:12%\"></td><td style=\"width:22%\"></td>"
            . "<td>".$Beneficiary['Beneficiary']['telefono']."</td>"
            . "<td>".$Beneficiary['Beneficiary']['email']."</td>"
            . "</tr></tbody>";
    $cnt++;
}

$tabla.="</tbody>";
$tabla.="</table>";

$pdf->writeHTML($tabla, true, false, false, false, '');
$pdf->Output('ficha.pdf', 'I');

?>