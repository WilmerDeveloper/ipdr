<?php

App::import('Vendor', 'tcpdf/tcpdf');
App::import('Vendor', 'EnLetras', array('file' => 'EnLetras.class.php'));

$pdf = new TCPDF("P", 'mm', "LETTER", true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(10, 5, 25);
$pdf->SetFont('Trebuchet', '', 12);
$V = new EnLetras();
$fecha = date('Y-m-d');
$mes = $V->getMontName($fecha);
$pdf->AddPage();
$pdf->SetFont('Trebuchet', '', 12);
$monto = $pago['Payment']['valor_desembolsado'];
$monto = number_format($monto, 0, ',', '.');
$codigo = $pago['Proyect']['codigo'];
$convocatoria = $pago['Call']['nombre'];

$supervisor = "CLAUDIA MARCELA MARTINEZ NARVAEZ";

if ($pago['Payment']['tipo'] == "Contrato plan cadena de valor") {
    $convenio = "Contrato cadena de valor";
    $supervisor = "";
} else {
    $convenio = $pago['Call']['convenio'];
}

if ($pago['Payment']['tipo'] == "Campesinos Cadena de valor"){
    $convenio = "";
}

if ($pago['Payment']['tipo'] == "Campesinos PDRET contrato 563" or $pago['Payment']['tipo'] == "Desplazados PDRET contrato 563"){
    $supervisor = "NINA VLADISLAV RODRIGUEZ VALERO";
}


if ($pago['Payment']['tipo'] == "Campesinos 2015" or $pago['Payment']['tipo'] == "Desplazados 2015"){
    $supervisor = "JUAN MANUEL LONDOÑO JARAMILLO";
    //$supervisor = "ADIELA ROCIO BOTIA SANCHEZ";
}


$fecha_res = $V->obtenerMes($resolucion['Resolution']['fecha']);
$annio_res = $V->obtenerAnnio($resolucion['Resolution']['fecha']);
$num_res = $resolucion['Resolution']['numero'];

$beneficiario = $pago['Beneficiary']['nombres'] . " " . $pago['Beneficiary']['primer_apellido'] . " " . $pago['Beneficiary']['segundo_apellido'];
$cedula = $pago['Beneficiary']['numero_identificacion'];

$telefono = $pago['Beneficiary']['telefono'];
if ($telefono != "")
    $telefono = "Teléfono :" . $pago['Beneficiary']['telefono'];

$direccion = $pago['Beneficiary']['direccion'];
if ($direccion != "")
    $direccion = "Dirección :" . $pago['Beneficiary']['direccion']. " - ". $pago['Departament']['name']." - ". $pago['City']['name'];

$nro_cuenta = $pago['Payment']['cuenta_beneficiario'];
$observaciones = $pago['Payment']['observaciones'];
$banco = $pago['Payment']['banco_beneficiario'];
$tipo_cuenta = $pago['Payment']['tipo_cuenta_beneficiario'];

App::Import('model', 'Property');
$Property = new Property();
$predios = $Property->find("all", array('recursive' => -1, 'conditions' => array('Property.proyect_id' => $pago['Proyect']['id']), 'fields' => array('Property.nombre')));
if (count($predios) > 3) {
    $size = "7";
} else {
    $size = "9";
}

$cdp = "";
$rp = "";
$objeto = "";

if ($pago['Payment']['tipo'] == "Campesinos") {
    $objeto = "POBLACION CAMPESINA - IMPLEMENTACIÓN DE DESARROLLO RURAL A NIVEL NACIONAL, PROYECTO  $codigo" . "-Contrato Interadministrativo";
    $rp = "63914";
    $cdp = "15714";
}
if ($pago['Payment']['tipo'] == "Desplazados") {
    $objeto = "POBLACIÓN DESPLAZADA - IMPLEMENTACIÓN DE DESARROLLO RURAL A NIVEL NACIONAL, PROYECTO  $codigo" . "-Contrato Interadministrativo";
    $rp = "64114";
    $cdp = "15614";
}
if ($pago['Payment']['tipo'] == "Contrato plan") {
    $objeto = "IMPLEMENTACIÓN DE DESARROLLO RURAL A NIVEL NACIONAL, PROYECTO $codigo" . "-Contrato Interadministrativo";
    $rp = "64214";
    $cdp = "15514";
}
if ($pago['Payment']['tipo'] == "Contrato plan cadena de valor") {
    $objeto = "IMPLEMENTACIÓN DE DESARROLLO RURAL A NIVEL NACIONAL, PROYECTO $codigo";
    $cdp = "43314";
    $rp = "N/A";
}
if ($pago['Call']['nombre'] == "2013") {
    $cdp = "N/A";
    $rp = "N/A";
}
if ($pago['Payment']['tipo'] == "Desplazados Cadena de valor") {
    $objeto = "POBLACIÓN DESPLAZADA - IMPLEMENTACIÓN DE DESARROLLO RURAL A NIVEL NACIONAL, PROYECTO $codigo";
    $cdp = "54114";
    $rp = "";
    $supervisor = "";
}
if ($pago['Payment']['tipo'] == "Campesinos Cadena de valor") {
    $objeto = "POBLACIÓN CAMPESINA - IMPLEMENTACIÓN DE DESARROLLO RURAL A NIVEL NACIONAL, PROYECTO $codigo";
    $cdp = "56914";
    $rp = "";
    $supervisor = "";
}
if ($pago['Payment']['tipo'] == "Campesinos PDRET cadena de valor") {
    $objeto = "POBLACIÓN CAMPESINA - APOYO PROYECTOS DE DESARROLLO RURAL CON ENFOQUE TERRITORIAL A NIVEL NACIONAL, PROYECTO $codigo";
    $cdp = "54314";
    $rp = "";
    $supervisor = "";
    $convenio ="";
}
if ($pago['Payment']['tipo'] == "Desplazados PDRET cadena de valor") {
    $objeto = "POBLACIÓN DESPLAZADA - APOYO PROYECTOS DE DESARROLLO RURAL CON ENFOQUE TERRITORIAL A NIVEL NACIONAL, PROYECTO $codigo";
    $cdp = "54314";
    $rp = "";
    $supervisor = "";
    $convenio ="";
}
if ($pago['Payment']['tipo'] == "Campesinos PDRET contrato 563") {
    $objeto = "POBLACIÓN CAMPESINA - APOYO PROYECTOS DE DESARROLLO RURAL CON ENFOQUE TERRITORIAL A NIVEL NACIONAL, PROYECTO $codigo -Contrato Interadministrativo ";
    $cdp = "15414";
    $rp = "64614";
    $convenio = "563/14";
}
if ($pago['Payment']['tipo'] == "Desplazados PDRET contrato 563") {
    $objeto = "POBLACIÓN DESPLAZADA - APOYO PROYECTOS DE DESARROLLO RURAL CON ENFOQUE TERRITORIAL A NIVEL NACIONAL, PROYECTO $codigo -Contrato Interadministrativo";
    $cdp = "15414";
    $rp = "64614";
    $convenio = "563/14";
}

if ($pago['Payment']['tipo'] == "Campesinos 2015") {
    $objeto = "POBLACIÓN CAMPESINA - APOYO PROYECTOS DE DESARROLLO RURAL CON ENFOQUE TERRITORIAL, NIVEL NACIONAL. PROYECTO $codigo";
    $cdp = "26615";
    $rp = "";
    $convenio = "";
}

if ($pago['Payment']['tipo'] == "Desplazados 2015") {
    $objeto = "POBLACIÓN DESPLAZADA - ASISTENCIA Y ATENCIÓN A LA POBLACIÓN VICTIMA DEL DESPLAZAMIENTO CON PROYECTOS DE DESARROLLO RURAL A NIVEL NACIONAL. $codigo";
    $cdp = "24215";
    $rp = "";
    $convenio = "";
}

if($pago['Payment']['formato'] != "F21"){
    $tbl = <<<EOD
<table cellpadding="2px" border="1" >
     <tr style="font-size:10">
        <td rowspan="3" width="130" align="center" ><img src="../webroot/img/logo_izq.jpg" /></td>
        <td width="180" align="left">MACROPROCESO: ADMINISTRATIVO Y FINANCIERO</td>
        <td width="110" align="center">CÓDIGO:<br>F7-AF-GRF-07</td>
        <td width="150" align="center" rowspan="3"><img src="../webroot/img/logo_der.jpg" /></td>
    </tr>
    <tr style="font-size:10">
        <td align="left">PROCESO:GESTIÓN RECURSOS FINANCIEROS</td>
        <td align="center">FECHA EDICIÓN:<br>10/12/2015</td>
    </tr>
    <tr style="font-size:10">
        <td align="left">FORMATO: CERTIFICACIÓN ESTÁNDAR - CENTRAL CUENTAS</td>
        <td align="center">Página:1 de 1</td>
    </tr>
    <tr style="font-size:12">
        <td colspan="4"><b>INFORMACIÓN BÁSICA</b></td>
    </tr>
    <tr style="background-color:#CCCCCC;font-size:10;">
        <td><b>ACTO ADMINTIVO No.</b></td>
        <td colspan="2" align="center"><b>BENEFICIARIO</b></td>
        <td align="center" ><b>NIT O CEDULA </b></td>
    </tr>
    <tr style="font-size:10">
        <td align="center">$num_res de $annio_res</td>
        <td colspan="2" align="center">$beneficiario</td>
        <td align="center" > $cedula</td>
    </tr>
    <tr style="text-align:center; background-color:#CCCCCC;font-size:10;">
        <td>No DE FACTURA</td>
        <td>FECHA DE LA FACTURA</td>
        <td>VALOR</td>
        <td>PERIODO</td>
    </tr>
    <tr style="font-size:10;text-align:center">
        <td>N/A</td>
        <td>N/A</td>
        <td>N/A</td>
        <td>N/A</td>
    </tr>
    <tr>
        <td align="center" style="background-color:#CCCCCC;font-size:10">CONCEPTO</td>
        <td colspan="3" align="center"></td>
    </tr>
    <tr style="font-size:$size">
        <td colspan="4" align="left">$objeto $convenio.</td>
    </tr>
    <tr style="background-color:#CCCCCC ;font-size:10" >
        <td align="center">INTERVENTOR</td>
        <td align="center">SUPERVISOR</td>
        <td colspan="2" align="left"> DEPENDENCIA</td>
    </tr>
    <tr style="font-size:10">
        <td  align="left" style="font-size:8" colspan="1" ></td>
        <td  align="left" style="font-size:9" colspan="1" >$supervisor</td>
        <td colspan="2" align="left">Subgerencia de Gestión y Desarrollo Productivo</td>
    </tr>
    <tr style="background-color:#CCCCCC;font-size:10"  >
        <td colspan="4" align="center"> CUENTA BANCARIA - Registrada en el SIIF</td>
    </tr>
    <tr style="font-size:10">
        <td  align="center">No.$nro_cuenta </td>
        <td  align="center"> Banco: $banco </td>
        <td colspan="2" align="center"> Cuenta: $nro_cuenta $tipo_cuenta</td>
    </tr>
    <tr style="font-size:10" align="left" >
        <td colspan="2" align="left"> CONTROL SALDOS DEL CONTRATO</td>
        <td  align="center"> </td>
        <td  align="center"></td>
    </tr>
    <tr style="font-size:10" align="left" >
        <td colspan="2" align="left"></td>
        <td  align="center">CDP</td>
        <td  align="center">RP</td>
    </tr>
    <tr align="left" style="font-size:10" >
        <td colspan="2" align="left"></td>
        <td align="center">$cdp</td>
        <td align="center">$rp</td>
    </tr>
     <tr align="left" style="font-size:10">
        <td colspan="2"  align="left" style="border-bottom: hidden"></td>
        <td align="center">CONTRATO</td>
        <td align="center">ANTICIPO</td>
    </tr>
     <tr align="left"  style="font-size:10">
        <td colspan="2"  align="left" style="font-size: 10;border-bottom-color:#ffffff">VALORES INICIALES</td>
        <td align="center">$ $monto </td>
        <td align="center" style="font-size: 10;border">$0</td>
    </tr>
    <tr align="left" style="font-size:10">
        <td  align="left" colspan="2" style="font-size: 9;border-color:#ffffff">+ADICIONES </td>
        <td  align="center"> $0</td>
        <td  align="center" >$0</td>
    </tr>
   <tr align="left" style="font-size:10">
        <td  align="left" colspan="2" style="font-size: 9;border-color:#ffffff">= VALORES TOTALES </td>
        <td  align="center">$ $monto</td>
        <td  align="center" >$0</td>
    </tr>
    <tr align="left" style="font-size:10">
        <td  align="left" colspan="2" style="font-size:9;border-color:#ffffff">=  TOTAL PAGOS Y/O AMORTIZACIONES ANTES DE ESTA FACTURA </td>
        <td  align="center">$0</td>
        <td  align="center" >$0</td>
    </tr>
    <tr align="left" style="font-size:10" >
        <td  align="left" colspan="2" style="font-size: 9;border-color:#ffffff">- PAGADO Y/O AMORTIZADO EN LA FECHA</td>
        <td  align="center">$ $monto</td>
        <td  align="center" >$0</td>
    </tr>
    <tr align="left" style="font-size:10">
        <td  align="left" colspan="2" style="font-size: 9;border-color:#ffffff">= VALORES TOTALES PAGADOS Y/O AMORTIZADO A LA FECHA </td>
        <td  align="center"> $ $monto</td>
        <td  align="center" >$0</td>
    </tr>
    <tr align="left" style="font-size:10">
        <td  align="left" colspan="2" style="font-size: 9;border-color:#ffffff"> = SALDOS ACTUALES (DESPUÉS DE ESTA FACTURA).</td>
        <td  align="center"> $0</td>
        <td  align="center" >$0</td>
    </tr>
    <tr align="left" style="font-size:10" >
        <td  align="center" colspan="4"> </td>
    </tr>
    <tr align="left" style="font-size:10" >
        <td  align="left" colspan="4"><b> OBSERVACIONES:</b></td>
    </tr>
        <tr align="left" style="font-size:9">
        <td  align="left" colspan="4">
        $beneficiario     
         <br>
        $telefono
        <br>
        $direccion
        </td>
    </tr>
    <tr style="font-size:9">
        <td align="left" rowspan="2" colspan="2"></td>
        <td   colspan="2" style="font-size: 8 ;text-align:justify;" >a. Cumplimiento del objeto del contrato: Es recibir a entera satisfacción los servicios contratados. </td>
    </tr>
    <tr style="font-size:9">
        <td  rowspan="2" colspan="2" style="font-size: 8;text-align:justify; "> b. Calidad del servicio: Es la evaluación de los recursos humanos, técnicos, financieros y materiales indispensables para la prestación óptima del servicio.</td>
    </tr>
    <tr style="font-size:9">
        <td align="center" colspan="2" >INTERVENTOR</td>
    </tr> 
   <tr style="font-size:9">
        <td colspan="2" ><br><br><br><br><br></td>
        <td colspan="2" rowspan="2" style="font-size: 8;text-align:justify;">c. Cumplimiento de las obligaciones contractuales: Es la realización de los deberes y funciones propias del objeto contractual. (Tareas, Responsabilidades, Trabajos, Relaciones interpersonales, entre otros) </td>
    </tr>
   <tr style="font-size:9">
        <td align="center" colspan="2">SUPERVISOR</td>
    </tr>
</table>
EOD;
}else{
    $tbl = <<<EOD
<table cellpadding="2px" border="1" >
     <tr style="font-size:10">
        <td rowspan="3" width="130" align="center" ><img src="../webroot/img/logo_izq.jpg" /></td>
        <td width="180" align="left">MACROPROCESO: ADMINISTRATIVO Y FINANCIERO</td>
        <td width="110" align="center">CÓDIGO:<br>F21-AF-GRF-03</td>
        <td width="150" align="center" rowspan="3"><img src="../webroot/img/logo_der.jpg" /></td>
    </tr>
    <tr style="font-size:10">
        <td align="left">PROCESO:GESTIÓN RECURSOS FINANCIEROS</td>
        <td align="center">FECHA EDICIÓN:<br>10/12/2015</td>
    </tr>
    <tr style="font-size:10">
        <td align="left">FORMATO: CERTIFICACIÓN ESTÁNDAR - CENTRAL CUENTAS - ACREEDORES SUJETOS A DEVOLUCIÓN</td>
        <td align="center">Página:1 de 1</td>
    </tr>
    <tr style="font-size:12">
        <td colspan="4"><b>INFORMACIÓN BÁSICA</b></td>
    </tr>
    <tr style="background-color:#CCCCCC;font-size:10;">
        <td><b>ACTO ADMINTIVO No.</b></td>
        <td colspan="2" align="center"><b>BENEFICIARIO</b></td>
        <td align="center" ><b>NIT O CEDULA </b></td>
    </tr>
    <tr style="font-size:10">
        <td align="center">$num_res de $annio_res</td>
        <td colspan="2" align="center">$beneficiario</td>
        <td align="center" > $cedula</td>
    </tr>
    <tr>
        <td align="center" style="background-color:#CCCCCC;font-size:10">CONCEPTO</td>
        <td colspan="3" align="center"></td>
    </tr>
    <tr style="font-size:$size">
        <td colspan="4" align="left">$objeto $convenio.</td>
    </tr>
    <tr style="background-color:#CCCCCC ;font-size:10" >
        <td align="center" colspan = "2">NOMBRE</td>
        <td align="center" colspan = "2">DEPENDENCIA</td>
    </tr>
    <tr style="font-size:10">
        <td  align="left" style="font-size:8" colspan="2" >JUAN MANUEL LONDOÑO JARAMILLO</td>
        <td colspan="2" align="left">Subgerencia de Gestión y Desarrollo Productivo</td>
    </tr>
    <tr style="background-color:#CCCCCC;font-size:10"  >
        <td colspan="4" align="center"> CUENTA BANCARIA - Registrada en el SIIF</td>
    </tr>
    <tr style="font-size:10">
        <td  align="center">No.$nro_cuenta </td>
        <td  align="center"> Banco: $banco </td>
        <td colspan="2" align="center"> Cuenta: $nro_cuenta $tipo_cuenta</td>
    </tr>
    <tr style="font-size:10" align="left" >
        <td colspan="2" align="left"> CONTROL SALDOS DEL CONTRATO</td>
        <td  align="center"> </td>
        <td  align="center"></td>
    </tr>
    <tr style="font-size:10" align="left" >
        <td colspan="2" align="left"></td>
        <td  align="center">CDP</td>
        <td  align="center">RP</td>
    </tr>
    <tr align="left" style="font-size:10" >
        <td colspan="2" align="left"></td>
        <td align="center">N/A</td>
        <td align="center">N/A</td>
    </tr>
     <tr align="left" style="font-size:10">
        <td colspan="2"  align="left" style="border-bottom: hidden"></td>
        <td align="center">CONTRATO</td>
        <td align="center">ANTICIPO</td>
    </tr>
     <tr align="left"  style="font-size:10">
        <td colspan="2"  align="left" style="font-size: 10;border-bottom-color:#ffffff">VALORES INICIALES</td>
        <td align="center">$ $monto </td>
        <td align="center" style="font-size: 10;border">$0</td>
    </tr>
    <tr align="left" style="font-size:10">
        <td  align="left" colspan="2" style="font-size: 9;border-color:#ffffff">+ADICIONES </td>
        <td  align="center"> $0</td>
        <td  align="center" >$0</td>
    </tr>
   <tr align="left" style="font-size:10">
        <td  align="left" colspan="2" style="font-size: 9;border-color:#ffffff">= VALORES TOTALES </td>
        <td  align="center">$ $monto</td>
        <td  align="center" >$0</td>
    </tr>
    <tr align="left" style="font-size:10">
        <td  align="left" colspan="2" style="font-size:9;border-color:#ffffff">=  TOTAL PAGOS Y/O AMORTIZACIONES ANTES DE ESTA FACTURA </td>
        <td  align="center">$0</td>
        <td  align="center" >$0</td>
    </tr>
    <tr align="left" style="font-size:10" >
        <td  align="left" colspan="2" style="font-size: 9;border-color:#ffffff">- PAGADO Y/O AMORTIZADO EN LA FECHA</td>
        <td  align="center">$ $monto</td>
        <td  align="center" >$0</td>
    </tr>
    <tr align="left" style="font-size:10">
        <td  align="left" colspan="2" style="font-size: 9;border-color:#ffffff">= VALORES TOTALES PAGADOS Y/O AMORTIZADO A LA FECHA </td>
        <td  align="center"> $ $monto</td>
        <td  align="center" >$0</td>
    </tr>
    <tr align="left" style="font-size:10">
        <td  align="left" colspan="2" style="font-size: 9;border-color:#ffffff"> = SALDOS ACTUALES (DESPUÉS DE ESTA FACTURA).</td>
        <td  align="center"> $0</td>
        <td  align="center" >$0</td>
    </tr>
    <tr align="left" style="font-size:10" >
        <td  align="center" colspan="4"> </td>
    </tr>
    <tr align="left" style="font-size:10" >
        <td  align="left" colspan="4"><b> OBSERVACIONES:</b></td>
    </tr>
        <tr align="left" style="font-size:9">
        <td  align="left" colspan="4">
        $beneficiario     
         <br>
        $telefono
        <br>
        $direccion
        </td>
    </tr>
    <tr style="font-size:9">
        <td align="left" rowspan="2" colspan="2"></td>
        <td   colspan="2" style="font-size: 8 ;text-align:justify;" >a. Cumplimiento del objeto del contrato: Es recibir a entera satisfacción los servicios contratados. </td>
    </tr>
    <tr style="font-size:9">
        <td rowspan="2" colspan="2" style="font-size: 8;text-align:justify; "> b. Calidad del servicio: Es la evaluación de los recursos humanos, técnicos, financieros y materiales indispensables para la prestación óptima del servicio.</td>
    </tr>
    <tr style="font-size:9">
        <td align="center" colspan="2">DEPENDENCIA</td>
    </tr> 
   <tr style="font-size:9">
        <td colspan="1" ><br></td>
        <td colspan="1" ><br></td>
        <td colspan="2" rowspan = "2" style="font-size: 8;text-align:justify;">c. Cumplimiento de las obligaciones contractuales: Es la realización de los deberes y funciones propias del objeto contractual. (Tareas, Responsabilidades, Trabajos, Relaciones interpersonales, entre otros) </td>
    </tr>
   <tr style="font-size:8">
        <td >Vo. Bo. Verificación área responsable</td>
        <td >Vo. Bo. Solicitud de trámite desembolso, previa verificación de cumplimiento de requisitos</td>
    </tr>

</table>
EOD;
}


$pdf->writeHTML($tbl, true, false, false, false, '');
$pdf->Output('certificacion.pdf', 'I');
?>
