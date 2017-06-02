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
<table  border="1" style=" font-size:8;"  cellpadding="4"  >
    <tbody>    
        <tr >
            <td rowspan="3" width="100px"  ><br><br><img src="../webroot/img/logo_izq.jpg" /></td>
            <td width="200px" align="left"  ><br><br>PROCEDIMIENTO: IMPLEMENTACIÓN DE PROYECTOS DE DESARROLLO RURAL</td>
            <td width="140px" align="center" >Código:<br> F18-PA-GRF-01</td>
            <td width="90px" align="center"  rowspan="3"><br><br><img src="../webroot/img/derecho.png" /></td>
        </tr>

        <tr  style="text-align:justify">
            
            <td align="center">SUBGERENCIA DE GESTION Y DESARROLLO PRODUCTIVO</td>
            <td align="center">Fecha Edición:<br> 21/08/2013</td>
        </tr>
        <tr  style="text-align:justify">
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

$pdf = new MYPDF("P", 'mm', "LETTER", true, 'UTF-8', false);

$pdf->setPrintFooter(false);
$pdf->SetMargins(15, 55, 15);
$pdf->AddPage();



$entidad = $evaluacion['InitialEvaluation']['nombre_aliado'];

$evaluador = $evaluacion['User']['nombre'] . " " . $evaluacion['User']['primer_apellido'];
$cedula = $evaluacion['User']['cedula'];

//$firma = "Usuario_firma_" . $evaluacion['User']['id'] . ".png";
//$imagen = "";
//if (file_exists($path = WWW_ROOT . DS . 'files' . DS . 'Users' . DS . $firma)) {
//    $imagen = "<img src=\"../webroot/files/Users/$firma\"  height=\"70\" width=\"150\" />";
//}
$fecha = date('d/m/Y');
$objetivo = $evaluacion['InitialEvaluation']['objetivo'];
$nombre = $evaluacion['InitialEvaluation']['nombre_proyecto'];
$origen = $evaluacion['InitialEvaluation']['origen_tema'];
$justificacion = $evaluacion['InitialEvaluation']['justificacion'];
$poblacion = $evaluacion['InitialEvaluation']['descripcion_poblacion'];
$resultados = $evaluacion['InitialEvaluation']['resultados_esperados'];
$innovacion = $evaluacion['InitialEvaluation']['innovacion'];
$concepto = $evaluacion['InitialEvaluation']['concepto_tecnico_final'];
$valor_total = $evaluacion['InitialEvaluation']['valor_total'];
$monto_solicitado = $evaluacion['InitialEvaluation']['monto_solicitado'];
$actividades = $evaluacion['InitialEvaluation']['programacion_actividades'];
$personal = $evaluacion['InitialEvaluation']['descripcion_personal_tecnico'];
$codigo = $proyecto['Proyect']['codigo'];
$regional = $evaluacion['Branch']['nombre'];

$evaluador = $evaluacion['User']['nombre'] . " " . $evaluacion['User']['primer_apellido'];
$fecha_finalizacion = $evaluacion['InitialEvaluation']['fecha_finalizacion'];

$tbl = <<<EOD

<table border = "1" cellpadding="4">
    <thead>
        <tr>
            <th>Nombre Evaluador</th>
            <th>Fecha finalización</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>$evaluador</td>
            <td>$fecha_finalizacion</td>
        </tr>
    </tbody>
</table >
<br><br>
EOD;

$tbl .= <<<EOD
<table  border="1" style=" font-size:smaller"  cellpadding="4"  >
    <tbody>    
        <tr nobr="true" style="text-align:justify">
            <td colspan="2">INFORME DE EVALUACIÓN TÉCNICA Y ECONÓMICA</td>
        </tr>

       <tr  >
            <td style="width:20%"   >Entidad acompañante</td>
            <td style="width:80%,text-align:justify"  >$entidad</td>
        </tr>
       <tr  >
            <td  >Nombre del proyecto</td>
            <td style="text-align:justify"  >$nombre</td>
        </tr>
        
       <tr  >
            <td  >Código del proyecto </td>
            <td style="text-align:justify"  >$codigo</td>
        </tr>
       <tr  style="text-align:justify">
            <td rowspan="2">Objetivo </td>
            <td>Objetivo general, objetivos específicos</td>
        </tr>
       <tr  style="text-align:justify">
            <td  >$objetivo</td>
        </tr>
       <tr>
            <td >Origen del tema </td>
            <td>Síntesis descripción general del proyecto</td>
        </tr>
       <tr >
            <td></td>
            <td style="text-align:justify">$origen</td>
        </tr>
       
       <tr  nobr="true"  style="text-align:justify" >
            <td  >Justificación </td>
            <td>$justificacion</td>
        </tr>
       
       
       <tr  nobr="true"  >
            <td  >Población a beneficiar </td>
            <td style="text-align:justify" >Descripcion de los beneficiarios, desplazados, campesinos, etnias, numero de familias, características socio económicas.		</td>
        </tr>
   
       <tr  nobr="true"  style="text-align:justify" >
            <td  > </td>
            <td  >$poblacion </td>
        </tr>
       <tr  nobr="true"   >
            <td  >Dirección territorial participante</td>
            <td  style="text-align:justify">Nombre de la Dirección Territorial Regional que participa en proceso de acompañamiento		</td>
        </tr>
       <tr  nobr="true"  style="text-align:justify" >
            <td  > </td>
            <td  >$regional </td>
        </tr>
   
       <tr  nobr="true"  style="text-align:justify" >
            <td  >Resultados esperados </td>
            <td  >Descripción de los resultados esperados  proyectados  del proyecto </td>
        </tr>
       <tr  nobr="true"  style="text-align:justify" >
            <td  > </td>
            <td  >$resultados </td>
        </tr>
   
       <tr  nobr="true"  style="text-align:justify" >
            <td  >Componentes de innovación y desarrollo tecnológico del proyecto </td>
            <td  >Descripción de los aspectos y/o elementos del proyecto que lo identifican como de innovación y desarrollo tecnológico.		 </td>
        </tr>
       <tr  nobr="true"  style="text-align:justify" >
            <td  > </td>
            <td  >$innovacion </td>
        </tr>
   
       <tr  nobr="true"  style="text-align:justify" >
            <td  >Personal técnico vinculado </td>
            <td  >Descripción  del personal que participa en el proyecto,  nombre del aliado estratégico, numero de profesionales que realizan el acompañamiento, profesión. Otros aliados o cooperantes.		 </td>
        </tr>
       <tr  nobr="true"  style="text-align:justify" >
            <td  > </td>
            <td  >$personal </td>
        </tr>
   
       <tr  nobr="true"  style="text-align:justify" >
            <td  >Proyección de las actividades en el tiempo. </td>
            <td  >Describir de manera rápida y concisa, las actividades programadas en el tiempo u horizonte del proyecto. 		 </td>
        </tr>
       <tr  nobr="true"  style="text-align:justify" >
            <td  ></td>
            <td  >$actividades  </td>
        </tr>
         
        </tbody>
</table>
EOD;
$pdf->writeHTML($tbl, false, false, false, false, '');
$tabla = <<<EOL
        <p nobr="true">
<table cellpadding="5px" border="1" style=" font-family: Trebuchet MS; font-size:8; text-align:justify" >
    <tbody>    
       <tr style="text-align:justify" >
            <td style="width:20%" rowspan="6" >Solicitud concreta al incoder del monto solicita para cofinanciación.</td>
            <td style="width:80%" >Viabilidad técnica proyecto.</td>
        </tr>
       <tr  style="text-align:justify" >
           
            <td  >$concepto </td>
        </tr>
   
       <tr   style="text-align:justify" >
            
            <td  >Valor total proyecto: $ (valor total) </td>
        </tr>
       <tr    style="text-align:justify" >
            
            <td  > $valor_total </td>
        </tr>
       <tr style="text-align:justify" >
         
            <td  >Valor solicitado al INCODER. </td>
        </tr>
       <tr style="text-align:justify" >
            <td  >$monto_solicitado</td>
        </tr> 
    </tbody>
</table>
        <br>         
<br>Fecha:$fecha<br><br>
Evaluador: $evaluador <br><br>Firma evaluador:<br><br><br>C.C :$cedula
</p>        
EOL;

$tbl.="<br>";

$pdf->writeHTML($tabla, true, false, false, false, '');


$pdf->Output('ficha.pdf', 'I');
echo $tbl;
?>
