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
            <td rowspan="3" width="90px"  ><br><br><img src="../webroot/img/logo_izq.jpg" /></td>
            <td width="200px" align="left"  ><br><br>PROCEDIMIENTO: IMPLEMENTACIÓN DE PROYECTOS DE DESARROLLO RURAL</td>
            <td width="140px" align="center" >Código:<br>F9-PM-IPDR-01</td>
            <td width="95px" align="center"  rowspan="3"><br><br><img src="../webroot/img/derecho.png" /></td>
        </tr>
        <tr  style="text-align:justify">
            <td align="center">SUBGERENCIA DE GESTIÓN Y DESARROLLO PRODUCTIVO</td>
            <td align="center">Fecha Edición:<br>30-03-2013</td>
        </tr>
        <tr style="text-align:justify">
            <td >IMPLEMENTACIÓN DE PROYECTOS DE DESARROLLO RURAL A NIVEL NACIONAL ATENCIÓN A POBLACIÓN DESPLAZADA Y CAMPESINA </td>
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
$nombrePredios = "";
$nombreMunicipios = "";
$nombreMunicipios = "";
$nombreDepartamentos = "";
$nombreVeredas = "";
foreach ($predios as $predio) {
    $nombrePredios.=$predio['Property']['nombre'] . " ";
    $nombreVeredas.=$predio['Property']['vereda'] . " ";
}
$nombreDepartamentos = $predio['Departament']['name'];
$nombreMunicipios = $predio['City']['name'] . " ";
$nombreVeredas = $predio['Property']['vereda'] . " ";

$viable = "Viable";
if ($sumaPuntaje < 70) {
    $viable = "No viable";
}
$entidad = $evaluacion['InitialEvaluation']['nombre_aliado'];
$concepto_tecnico = $evaluacion['InitialEvaluation']['concepto_tecnico_final'];
$nombre = $evaluacion['InitialEvaluation']['nombre_proyecto'];
$codigo = $proyecto['Proyect']['codigo'];

$evaluador = $evaluacion['User']['nombre'] . " " . $evaluacion['User']['primer_apellido'];
$fecha_finalizacion = $evaluacion['InitialEvaluation']['fecha_finalizacion'];

$valor_total_proyecto_txt = number_format($evaluacion['InitialEvaluation']['valor_total'], 0, ",", ".");
$monto_solicitado_txt = number_format($evaluacion['InitialEvaluation']['monto_solicitado'], 0, ",", ".");

//$tbl = <<<EOD
//
//<table border = "1" cellpadding="4">
//    <thead>
//        <tr>
//            <th>Nombre Evaluador</th>
//            <th>Fecha finalización</th>
//        </tr>
//    </thead>
//    <tbody>
//        <tr>
//            <td>$evaluador</td>
//            <td>$fecha_finalizacion</td>
//        </tr>
//    </tbody>
//</table >
//<br><br>
//EOD;


$tbl = <<<EOD
<table  border="1" style="font-size:small;width:100% "  cellpadding="4"  >
    <tbody>    
        <tr  style="text-align:center">
            <td colspan="2">INFORME DE VIABILIZACIÓN TÉCNICA Y ECONÓMICA</td>
        </tr>
       <tr style="text-align:justify">
            <td>NOMBRE DEL PROYECTO</td>
            <td>$nombre</td>
        </tr>
        
       <tr  style="text-align:justify">
            <td>CÓDIGO DEL PROYECTO </td>
            <td>$codigo</td>
        </tr>        
        <tr style="text-align:justify">
            <td>NOMBRE DEL PREDIO</td>
            <td>$nombrePredios</td>
        </tr>
        
       <tr style="text-align:justify">
            <td>VEREDA</td>
            <td>$nombreVeredas</td>
        </tr>
        
       <tr  style="text-align:justify">
            <td>MUNICIPIO</td>
            <td>$nombreMunicipios</td>
        </tr>

        <tr style="text-align:justify">
            <td>DEPARTAMENTO</td>
            <td>$nombreDepartamentos</td>
        </tr>
        <tr style="text-align:justify">
            <td>NÚMERO DE FAMILIAS BENEFICIARIAS <BR>DE LA COFINANCIACIÓN</td>
            <td>$familias_beneficiarias</td>
        </tr>
        <tr style="text-align:justify">
            <td>VALOR TOTAL DEL PROYECTO</td>
            <td>$ $valor_total_proyecto_txt</td>
        </tr>
        <tr style="text-align:justify">
            <td>VALOR TOTAL DE LA COFINANCIACIÓN INCODER</td>
            <td>$ $monto_solicitado_txt</td>
        </tr>
   </tbody>
</table>
EOD;

$tbl.="<br>";
$tbl.= <<<EOD
<table  border="1" style=" font-size:small"  cellpadding="4" nobr="true"  >
    <tbody>    
        <tr style="text-align:justify">
            <th style="width:65%">Concepto Técnico Final </th>
            <th style="width:12%">Puntaje máximo </th>
            <th style="width:13%">Puntaje obtenido  </th>
            <th style="width:10%">Viable  </th>
        </tr>
        <tr  style="text-align:justify" >
            <td>$concepto_tecnico </td>
            <td>$puntajeMaximo </td>
            <td>$sumaPuntaje </td>
            <td>$viable  </td>
        </tr>
    </tbody>
</table>
EOD;

$lineaBase = "";
$participacion = "";
$tecnicos = "";
$financieros = "";
$ambientales = "";

foreach ($caracterizaciones as $value) {
    if ($value['Requirement']['tipo'] == "Caracterización")
        $lineaBase.=$value['InitialEvaluationRequirement']['concepto'] . "\n";
    if ($value['Requirement']['tipo'] == "Formulación")
        $participacion.=$value['InitialEvaluationRequirement']['concepto'] . "\n";
    if ($value['Requirement']['tipo'] == "Criterios técnicos")
        $tecnicos.=$value['InitialEvaluationRequirement']['concepto'] . "\n";
    if ($value['Requirement']['tipo'] == "Análisis financiero")
        $financieros.=$value['InitialEvaluationRequirement']['concepto'] . "\n";
    if ($value['Requirement']['tipo'] == "Componente ambiental")
        $ambientales.=$value['InitialEvaluationRequirement']['concepto'] . "\n";
}

$tbl.="<br>";

$tbl.= <<<EOD
<table  border="1"  cellpadding="4" style="font-size: small" nobr="true" >
    <tbody>    
        <tr nobr="true" style="text-align:justify">
            <td>CRITERIO 1. LEVANTAMIENTO DE LINEA BASE (CARACTERIZACIÓN DE PREDIOS Y FAMILIAS)	</td>
            
        </tr>
        <tr nobr="true" style="text-align:justify">
            <td>$lineaBase</td>
            
        </tr>
        <tr nobr="true" style="text-align:justify">
            <td>CRITERIO 2. FORMULACIÓN PARTICIPATIVA DEL PROYECTO</td>
            
        </tr>
        <tr nobr="true" style="text-align:justify">
            <td>$participacion</td>
            
        </tr>
        <tr nobr="true" style="text-align:justify">
            <td>CRITERIO 3. CRITERIOS  TÉCNICOS</td>
        </tr>
        <tr nobr="true" style="text-align:justify">
            <td >$tecnicos</td>
            
        </tr>
        <tr nobr="true" style="text-align:justify">
            <td>CRITERIO 4. ANÁLISIS FINANCIERO  DEL PROYECTO </td>
        </tr>
        <tr nobr="true" style="text-align:justify">
            <td>$financieros</td>
        </tr>
        <tr nobr="true" style="text-align:justify">
            <td>CRITERIO 5. COMPONENTE AMBIENTAL</td>
        </tr>
        <tr nobr="true" style="text-align:justify">
            <td>$ambientales</td>
        </tr>
    </tbody>
</table>
EOD;
$tbl.="<br>";


$calificacionEconomica = $evaluacion['InitialEvaluation']['verificacion_economica'];
$topes = $evaluacion['InitialEvaluation']['topes_maximos'];
$evEconomica = $evaluacion['InitialEvaluation']['evaluacion_economica'];
$conEconomico = $evaluacion['InitialEvaluation']['concepto_economico'];
$riesgo = $evaluacion['InitialEvaluation']['riesgo'];
$recomendaciones = $evaluacion['InitialEvaluation']['recomendaciones'];
$tbl.= <<<EOD
<table  border="1" style=" font-size:small;width:100%"  cellpadding="4"   >
    <tbody>    
        <tr nobr="true" style="text-align:justify;" >
            <td width="70%">VERIFICACIÓN ECONÓMICA (Cumple o no con la totalidad de requerimientos economicos y financieros?)</td>
            <td width="30%">$calificacionEconomica</td>
        </tr>
        
        <tr nobr="true" style="text-align:justify">
            <td>La propuesta para la implementación de proyectos de desarrollo rural cumple  o no con los topes máximos de cofinanciación establecidos por INCODER.</td>
            <td>$topes</td>
        </tr>
        <tr nobr="true" style="text-align:justify">
            <td>De acuerdo a la evaluación económica realizada, la actual propuesta CUMPLE O NO con los lineamientos :  Rubros financiables, rubros no financiables, recursos de contrapartida, duración máxima.</td>
            <td>$evEconomica</td>
        </tr>
        <tr nobr="true" style="text-align:justify">
            <td colspan="2"> Concepto Económico Final </td>
        </tr>
        <tr nobr="true" style="text-align:justify">
             <td colspan="2">$conEconomico</td>
        </tr>
    </tbody>
</table>
EOD;

$tbl.="<br>";

$tbl.="<table border=\"1\" style=\"font-size:small;text-align:justify;width:100%\"  cellpadding=\"4\"  >
            <tr nobr=\"true\">
                <td>Principales riesgos del proyecto</td>
            </tr>
            <tr nobr=\"true\">
                <td>$riesgo</td>
            </tr>
    </table>";

$tbl.="<br>";
$fecha = date('d/m/Y');
$cedula = $evaluacion['User']['cedula'];
//$evaluador = $evaluacion['User']['nombre'] . " " . $evaluacion['User']['primer_apellido'];
//$firma = "Usuario_firma_" . $evaluacion['User']['id'] . ".png";
//$imagen = "";
//if (file_exists($path = WWW_ROOT . DS . 'files' . DS . 'Users' . DS . $firma)) {
//    $imagen = "<img src=\"../webroot/files/Users/$firma\"  height=\"70\" width=\"150\" />";
//}
$tbl.= <<<EOD
<table  border="1" style=" font-size:small;width:100%"  cellpadding="4"  >
        <tr nobr="true" style="text-align:justify;" >
            <td>Recomendaciones</td>
        </tr>
        <tr nobr="true" style="text-align:justify;" >
            <td>$recomendaciones</td>
        </tr>
</table>
<br>         
<br>Fecha:$fecha<br><br>
Viabilizador: $evaluador <br><br>Firma evaluador:<br><br>C.C :$cedula    
         
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
$pdf->Output('resumen.pdf', 'I');
?>