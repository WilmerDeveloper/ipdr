<?php

App::import('Vendor', 'tcpdf/tcpdf');
//App::import('Vendor', 'tcpdf/config/lang/eng.php');
App::import('Vendor', 'EnLetras', array('file' => 'EnLetras.class.php'));

$a = new TCPDF();

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
<table  border="1" style=" font-size:8;"  cellpadding="4"  >
    <tbody>    
        <tr >
            <td rowspan="3" width="100px"  ><br><br><img src="../webroot/img/logo_izq.jpg" /></td>
            <td width="200px" align="left"  ><br><br>PROCEDIMIENTO: IMPLEMENTACIÓN DE PROYECTOS DE DESARROLLO RURAL</td>
            <td width="140px" align="center" >Código:<br> F18-PA-GRF-01</td>
            <td width="100px" align="center"  rowspan="3"><br><br><img src="../webroot/img/derecho.png" /></td>
        </tr>

        <tr nobr="true" style="text-align:justify">
            
            <td align="center">SUBGERENCIA DE GESTION Y DESARROLLO PRODUCTIVO</td>
            <td align="center">FECHA EDICIÓN:<br> 6-11-2012</td>
        </tr>
        <tr nobr="true" style="text-align:justify">
            <td  >IMPLEMENTACION DE PROYECTOS DE DESARROLLO RURAL A NIVEL NACIONAL ATENCIÓN A POBLACIÓN DESPLAZADA Y CAMPESINA </td>
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

$pdf = new MYPDF("L", 'mm', "FOLIO", true, 'UTF-8', false);

$pdf->setPrintFooter(false);
$pdf->setPrintHeader(false);
$pdf->SetMargins(5, 20, 0);
$pdf->AddPage();
$tbl = "<b style=\"text-align:center\">INFORME VISITA VERIFICACIÓN A PREDIOS</b><br><br><br>";
$tbl.="<b style=\"text-align:center\">ZONA:________________________________</b><br><br>";
$tbl.="<b style=\"text-align:left\">  FECHA DE LA VISITA:____________    Nombre Del Responsable De La Visita_______________________________</b><br><br>";

$nombrePredio = $predio['Property']['nombre'];
$municipio = $predio['City']['name'];
$departamento = $predio['Departament']['name'];
$vereda = $predio['Property']['vereda'];
$tbl.= <<<EOD
      

<table  border="0" style=" font-size:10;"  cellpadding="4"  >
    <tbody>    
        <tr nobr="true" style="text-align:justify;" >
            <td>NOMBRE DEL PREDIO:</td>
            <td>VEREDA:</td>
            <td>MUNICIPIO:</td>
            <td>DEPARTAMENTO:</td>
        </tr>
        <tr nobr="true" style="text-align:justify;" >
            <td>$nombrePredio</td>
            <td>$vereda</td>
            <td>$municipio</td>
            <td>$departamento</td>
        </tr>
        
       
        
    </tbody>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
App::Import('Model', 'Beneficiary');
$Beneficiary = new Beneficiary();
$beneficiarios = $Beneficiary->find('all', array('conditions' => array('Beneficiary.property_id' => $predio['Property']['id'], 'Beneficiary.beneficiary_id' => 0), 'fields' => array('Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.id', 'Beneficiary.tipo_identificacion', 'Beneficiary.numero_identificacion', 'Beneficiary.id')));


$tbl = <<<EOD
      

<table  border="1"   cellpadding="4" style="text-align:center;font-size:8;width=100%"  >
    <tbody>    
        <tr  nobr="true"  >
            <td style="width:8%;">Nombre del productor</td>
            <td style="width:8%;">Documento de Identidad</td>
            <td style="width:6%;">¿Es propietario? (Si/Ni)</td>
            <td colspan="2" style="width:5%;">¿Está en el listado del incoder?</td>
            <td colspan="2" style="width:12%;">Si no està en el listado.¿En que calidad se encuentra en el predio?</td>
            <td style="width:5%;">Área</td>
            <td style="width:5%;">Marque x si ha fallecido</td>
            <td style="width:5%;">Marque x si ha fallecido y el predio tiene sucesión</td>
            <td  style="width:80px;">Revisión de requisitos</td>
            <td  style="width:320px;">Observaciones (Situación social,ambiental,productiva,seguridad)</td>
        </tr>
     
EOD;

$tbl.= "<tr nobr=\"true\" style=\"text-align:justify; \" ><td></td><td></td><td></td><td>Si</td><td>No</td><td>Arrendatario</td><td>Otro.¿Cúal?</td><td> </td><td> </td><td> </td><td></td><td></td></tr>";


foreach ($beneficiarios as $beneficiario) {
    $calificacion = "";
    if ($requisitos = $Beneficiary->BeneficiaryRequirement->find('all', array('conditions' => array('BeneficiaryRequirement.beneficiary_id' => $beneficiario['Beneficiary']['id'])))) {
        foreach ($requisitos as $requisito) {
            if ($requisito['BeneficiaryRequirement']['calificacion'] != "Cumple") {
                $calificacion.=strtolower($requisito['InitialRequirement']['texto'] ). ":<br>" . $requisito['BeneficiaryRequirement']['calificacion'] . "<br>";
            }
        }
    } else {
        $calificacion = "No se han evaluado requisitos";
    }
    $tbl.= "<tr nobr=\"true\" style=\"text-align:justify; height:150px; \" ><td><br><br><br>" . $beneficiario['Beneficiary']['nombres'] . " " . $beneficiario['Beneficiary']['primer_apellido'] . "<br><br><br><br></td><td><br><br><br> " . $beneficiario['Beneficiary']['tipo_identificacion'] . " " . $beneficiario['Beneficiary']['numero_identificacion'] . "</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>$calificacion</td><td></td></tr>";
    $calificacionCon="";
    if ($conyuge = $Beneficiary->find('first', array('conditions' => array('Beneficiary.beneficiary_id' => $beneficiario['Beneficiary']['id']), 'fields' => array('Beneficiary.nombres','Beneficiary.id', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.id', 'Beneficiary.tipo_identificacion', 'Beneficiary.numero_identificacion')))) {

        if ($requisitosCon = $Beneficiary->BeneficiaryRequirement->find('all', array('conditions' => array('BeneficiaryRequirement.beneficiary_id' => $conyuge['Beneficiary']['id'])))) {
            foreach ($requisitosCon as $requisitoCon) {
                if ($requisitoCon['BeneficiaryRequirement']['calificacion'] != "Cumple") {
                    $calificacionCon.=strtolower($requisitoCon['InitialRequirement']['texto']) . ":<br>" . $requisitoCon['BeneficiaryRequirement']['calificacion'] . "<br>";
                }
            }
        } else {
            $calificacionCon = "No se han evaluado requisitos";
        }
          
        $tbl.= "<tr nobr=\"true\" style=\"text-align:justify; height:150px; \" ><td><br><br><br>" . $conyuge['Beneficiary']['nombres'] . " " . $conyuge['Beneficiary']['primer_apellido'] . "<br><br><br><br></td><td><br><br><br> " . $conyuge['Beneficiary']['tipo_identificacion'] . " " . $conyuge['Beneficiary']['numero_identificacion'] . "</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>$calificacionCon</td><td></td></tr>";
    }
}
$tbl.= "</tbody></table>";

$pdf->writeHTML($tbl, true, false, false, false, '');
$pdf->Output('Listado.pdf', 'D');
?>
