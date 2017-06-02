<?php

App::import('Vendor', 'tcpdf/tcpdf');
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
            <td width="200px" align="left"  ><br><br>MACROPROCESO: GENERACIÓN DE INGRESOS</td>
            <td width="140px" align="center" >Código:<br>CÓDIGO: F21-GI-IPDR-02</td>
            <td width="95px" align="center"  rowspan="3"><br><br><img src="../webroot/img/derecho.png" /></td>
        </tr>
        <tr style="text-align:justify">
            <td align="center">PROCESO: IMPLEMENTACIÓN DE PROYECTOS DE DESARROLLO RURAL –IPDR</td>
            <td align="center">Fecha Edición:<br>26/01/2016</td>
        </tr>
        <tr style="text-align:justify">
            <td>FORMATO: INFORME DE CIERRE FINANCIERO Y AVANCE FISICO DE PROYECTO</td>
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
$EnLetras = new EnLetras();
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


$codigo = $proyecto['Proyect']['codigo'];
$valor_total_proyecto_txt = number_format($evaluacion['InitialEvaluation']['valor_total'], 0, ",", ".");
$monto_solicitado_txt = number_format($evaluacion['InitialEvaluation']['monto_solicitado'], 0, ",", ".");

$tbl = <<<EOD
<table border="1" style="font-size:small;width:100%" cellpadding="4">
    <tbody>    
        <tr style="text-align:center">
            <td colspan="2">INFORMACION BÁSICA</td>
        </tr>
        <tr style="text-align:justify">
            <td>NOMBRE PROYECTO</td>
            <td>{$evaluacion['InitialEvaluation']['nombre_proyecto']}</td>
        </tr>
       <tr style="text-align:justify">
            <td>CÓDIGO DEL PROYECTO </td>
            <td>$codigo</td>
        </tr>
        <tr style="text-align:justify">
            <td>NÚMERO DE FAMILIAS CAMPESINAS</td>
            <td>$familias_campesinas</td>
        </tr>
        <tr style="text-align:justify">
            <td>NÚMERO DE FAMILIAS DESPLAZADAS</td>
            <td>$familias_desplazadas</td>
        </tr>
        <tr style="text-align:justify">
            <td>VALOR TOTAL DEL PROYECTO</td>
            <td>$ $valor_total_proyecto_txt</td>
        </tr>
        <tr style="text-align:justify">
            <td>VALOR TOTAL DE LA COFINANCIACIÓN INCODER</td>
            <td>$ $monto_solicitado_txt</td>
        </tr>
        <tr style="text-align:justify">
            <td>DEPARTAMENTO</td>
            <td>$nombreDepartamentos</td>
        </tr>
        <tr style="text-align:justify">
            <td>MUNICIPIO</td>
            <td>$nombreMunicipios</td>
        </tr>
        <tr style="text-align:justify">
            <td>VEREDA</td>
            <td>$nombreVeredas</td>
        </tr>
        <tr style="text-align:justify">
            <td>NOMBRE DEL PREDIO</td>
            <td>{$nombrePredios}</td>
        </tr>
        <tr style="text-align:justify">
            <td>NOMBRE DEL REPRESENTANTE</td>
            <td>{$reporteFinal['FinalReport']['nombre_representante']}</td>
        </tr>
        <tr style="text-align:justify">
            <td>DIRECCIÓN DEL REPRESENTANTE</td>
            <td>{$reporteFinal['FinalReport']['direccion_representante']}</td>
        </tr>
        <tr style="text-align:justify">
            <td>TELÉFONO CONTACTO</td>
            <td>{$reporteFinal['FinalReport']['telefono_contacto']}</td>
        </tr>
        <tr style="text-align:justify">
            <td>TIPO PROYECTO</td>
            <td>{$reporteFinal['FinalReport']['tipo_proyecto']}</td>
        </tr>
        <tr style="text-align:justify">
            <td>OBSERVACIONES UBICACIÓN</td>
            <td>{$reporteFinal['FinalReport']['ubicacion']}</td>
        </tr>
   </tbody>
</table>
EOD;
$tbl.="<br>";

//inicio modificaciones
if(count($modificaciones)>0){
    $tbl.= <<<EOD
<table border="1" style="font-size:small;width:100%" cellpadding="4">
    <tbody>    
        <tr style="text-align:center">
            <td colspan="2">RELACIÓN DE MODIFICACIONES</td>
        </tr>
    </tbody>
</table>
EOD;
    $tbl.= <<<EOD
<table border="1" style="font-size:small;width:100%" cellpadding="4">
    <tbody>    
        <tr style="text-align:justify">
            <td style="width: 20%">TIPO DE MODIFICACIÓN (SUSTANCIAL/NO SUSTANCIAL)</td>
            <td style="width: 20%">FECHA DE SOLICITUD</td>
            <td style="width: 60%">ASUNTO DE LA SOLICITUD</td>
        </tr>
EOD;
}

foreach ($modificaciones as $modificacion){
    $tbl.= <<<EOD
 
        <tr style="text-align:justify">
            <td>{$modificacion['Follow']['tipo']}</td>
            <td>{$modificacion['Follow']['fecha']}</td>
            <td>{$modificacion['Follow']['observaciones']}</td>
        </tr>

EOD;
}
$tbl.= <<<EOD
    </tbody>
</table>
EOD;
//fin modificaciones

//inicio comites
$tbl.="<br>";
$tbl.= <<<EOD
<table border="1" style="font-size:small;width:100%" cellpadding="4">
    <tbody>    
        <tr style="text-align:center">
            <td colspan="2">RELACIÓN DE COMITES DE COMPRA</td>
        </tr>
    </tbody>
</table>
EOD;

$tbl.= <<<EOD
<table border="1" style="font-size:small;width:100%" cellpadding="4">
    <tbody>    
        <tr style="text-align:justify">
            <td>No.</td>
            <td>Fecha</td>
            <td>VALOR EJECUTADO</td>
        </tr>
EOD;

$i= 0;
$suma_comite = 0;
foreach ($comites as $comite){
    $suma_comite += $comite['Committee']['valor'];
    $i++;
    $valor_comite = number_format($comite['Committee']['valor'], 0, ",", ".");
    $tbl.= <<<EOD
        <tr style="text-align:justify">
            <td>{$i}</td>
            <td>{$comite['Committee']['fecha']}</td>
            <td>$ {$valor_comite}</td>
        </tr>
EOD;
}

$valor_total_comite = number_format($suma_comite, 0, ",", ".");

$tbl.= <<<EOD
        <tr style="text-align:justify">
            <td colspan="2">TOTAL</td>
            <td>$ {$valor_total_comite}</td>
        </tr>
EOD;

$tbl.= <<<EOD
    </tbody>
</table>
EOD;
$tbl.="<br>";
//inicio comites

//inicio saldos
$tbl.="<br>";

$tbl.= <<<EOD
<table border="1" style="font-size:small;width:100%" cellpadding="4">
    <tbody>    
        <tr style="text-align:center">
            <td colspan="2">RESUMEN ÚLTIMO CONTROL DE SALDOS </td>
        </tr>
    </tbody>
</table>
EOD;

//inicio desembolsos
$total_consignado = 0;
foreach ($pagos as $pago) {
    $total_consignado += $pago['Payment']['valor_desembolsado'];
    $tbl.= <<<EOD
<table border="1" style="font-size:small;width:100%" cellpadding="4">
    <tbody>    
        <tr style="text-align:justify">
            <td>Tipo de cuenta</td>
            <td>{$pago['Payment']['tipo_cuenta_beneficiario']}</td>
        </tr>
        <tr style="text-align:justify">
            <td>Banco y sucursal</td>
            <td>{$pago['Payment']['banco_beneficiario']}</td>
        </tr>
        <tr style="text-align:justify">
            <td>Fecha del Desembolso</td>
            <td>{$pago['Payment']['fecha_desembolso']}</td>
        </tr>
    </tbody>
</table>
EOD;
}


$deposito_inicial = number_format($reporteFinal['FinalReport']['deposito_inicial'], 0, ",", ".");
$otros_depositos = number_format($reporteFinal['FinalReport']['otros_depositos'], 0, ",", ".");
$intereses_ganados = number_format($reporteFinal['FinalReport']['intereses_ganados'], 0, ",", ".");
$costos_financieros= number_format($reporteFinal['FinalReport']['costos_financieros'], 0, ",", ".");
$saldo= number_format($saldo_cuenta, 0, ",", ".");
$valor_desembolsado = "";
$valor_desembolsado = number_format($total_consignado, 0, ",", ".");
//fin desembolsos
$tbl.="<br>";

$tbl.= <<<EOD
<table border="1" style="font-size:small;width:100%" cellpadding="4">
    <tbody>    
        <tr style="text-align:center">
            <td colspan="2">+ VALOR APERTURA CUENTA</td>
            <td colspan="2">$ {$deposito_inicial}</td>
        </tr>
        <tr style="text-align:center">
            <td colspan="2">+ VALOR COFINANCIACIÓN INCODER</td>
            <td colspan="2">$ {$valor_desembolsado}</td>
        </tr>
        <tr style="text-align:center">
            <td colspan="2">+ OTROS DEPÓSITOS</td>
            <td colspan="2">$ {$otros_depositos}</td>
        </tr>
        <tr style="text-align:center">
            <td colspan="2">+ INTERESES GANADOS</td>
            <td colspan="2">$ {$intereses_ganados}</td>
        </tr>
        <tr style="text-align:center">
            <td colspan="2">- COMPRAS</td>
            <td colspan="2">$ {$valor_total_comite}</td>
        </tr>
        <tr style="text-align:center">
            <td colspan="2">- COSTOS FINANCIEROS</td>
            <td colspan="2">$ {$costos_financieros}</td>
        </tr>
        <tr style="text-align:center">
            <td colspan="2">= SALDO EN CUENTA</td>
            <td colspan="2">$ {$saldo}</td>
        </tr>
    </tbody>
</table>
EOD;
//fin saldos
if(($total_consignado+$reporteFinal['FinalReport']['deposito_inicial']+$reporteFinal['FinalReport']['otros_depositos']+$reporteFinal['FinalReport']['intereses_ganados']
        -$reporteFinal['FinalReport']['costos_financieros']-$suma_comite)!=$saldo){
    $tbl.= <<<EOD
<table border="1" style="font-size:small;width:100%" cellpadding="4">
    <tbody>    
        <tr style="text-align:justify">
            <td colspan="2">POR FAVOR VERIFICAR LOS VALORES, (VALOR APERTURA CUENTA + VALOR COFINANCIACIÓN INCODER + OTROS DEPÓSITOS + INTERESES GANADOS), DEBE SER IGUAL
                A (COMPRAS + COSTOS FINANCIEROS) Y LA DIFERENCIA DEL SEGUNDO CON EL PRIMERO DEBE SER IGUAL AL SALDO EN LA CUENTA.</td>
        </tr>
    </tbody>
</table>
EOD;
$tbl.="<br>";
}
            
$tbl.="<br>";

$tbl.="<p>La información a consignar corresponde al formato F-17 de Control y Seguimiento a Saldos en cuentas de manejo controlado </p><br>";
$tbl.="<p>Fecha de cierre de la cuenta de manejo controlado: {$reporteFinal['FinalReport']['fecha_cierre']}</p><br>";

$tbl.= <<<EOD
<table border="1" style="font-size:small;width:100%" cellpadding="4">
    <tbody>    
        <tr style="text-align:justify">
            <td colspan="2">OBSERVACIONES DE LA EJECUCIÓN FINANCIERA: {$reporteFinal['FinalReport']['financiera']}</td>
        </tr>
    </tbody>
</table>
EOD;
$tbl.="<p> </p><br>";

//inicio lineas productivas
$tbl.= <<<EOD
<table border="1" style="font-size:small;width:100%" cellpadding="4">
    <tbody>    
        <tr style="text-align:justify">
            <td>LINEA PRODUCTIVA</td>
            <td>CANTIDAD PROGRAMADA</td>
            <td>CANTIDAD REAL</td>
        </tr>
EOD;
foreach ($lineas_productivas as $linea_productiva){
$tbl.= <<<EOD
        <tr style="text-align:justify">
            <td>{$linea_productiva['ProductiveActivity']['nombre']}</td>
            <td>{$linea_productiva['FollowProduct']['cantidad']}</td>
            <td>{$linea_productiva['FollowProduct']['cantidad_real']}</td>
        </tr>
EOD;
}
$tbl.= <<<EOD
    </tbody>
</table>
<br><br>
EOD;
//fin lineas productivas
$tbl.="<p> </p><br>";
$tbl.="<p>PORCENTAJE DE EJECUCIÓN FISICA: {$ejecucion_fisica} % </p><br>";

//inicio visitas
$tbl.="<br>";
$tbl.= <<<EOD
<table border="1" style="font-size:small;width:100%" cellpadding="4">
    <tbody>    
        <tr style="text-align:center">
            <td colspan="2">VISITAS DE SEGUIMIENTO </td>
        </tr>
    </tbody>
</table>
EOD;

$tbl.= <<<EOD
<table border="1" style="font-size:small;width:100%" cellpadding="4">
    <tbody>    
        <tr style="text-align:justify">
            <td style="width: 20%">No</td>
            <td style="width: 80%">Fecha</td>
        </tr>
EOD;

$i = 0;
foreach ($visitas as $visita){
$i++;
$fecha_visita = date("Y-m-d", strtotime($visita['visit']['fecha']));
$tbl.= <<<EOD
        <tr style="text-align:justify">
            <td>{$i}</td>
            <td>{$fecha_visita}</td>
        </tr>
EOD;
}
$tbl.= <<<EOD
    </tbody>
</table>
EOD;
//fin visitas

//inicio acompañamiento
$tbl.="<p> </p><br>";

$tbl.= <<<EOD
<table border="1" style="font-size:small;width:100%" cellpadding="4">
    <tbody>    
        <tr style="text-align:center">
            <td colspan="2">VISITAS DE ACOMPAÑAMIENTO</td>
        </tr>
    </tbody>
</table>
EOD;
$tbl.="<br>";
$tbl.= <<<EOD
<table border="1" style="font-size:small;width:100%" cellpadding="4">
    <tbody>    
        <tr style="text-align:justify">
            <td style="width: 20%">No</td>
            <td style="width: 20%">Fecha</td>
            <td style="width: 60%">ASUNTO (aclarar si el acompañamiento es de tipo técnico, comercial, ambiental o socioorganizativo)</td>
        </tr>
EOD;

$i = 0;
foreach ($acompanamientos as $acompanamiento){
$i++;
$tbl.= <<<EOD
        <tr style="text-align:justify">
            <td style="width: 20%">{$i}</td>
            <td style="width: 20%">{$acompanamiento['advice']['fecha']}</td>
            <td style="width: 60%">{$acompanamiento['advice']['observaciones']}</td>
        </tr>
EOD;
}
$tbl.= <<<EOD
    </tbody>
</table>
<br><br>
EOD;
//fin acompañamiento
$tbl.="<p>La información citada en los cuadros 9 y 10 debe coincidir con la información cargada en el módulo de seguimiento del aplicativo.</p><br>";
$tbl.= <<<EOD
<table border="1" style="font-size:small;width:100%" cellpadding="4">
    <tbody>    
        <tr style="text-align:justify">
            <td colspan="2">DESCRIPCIÓN TÉCNICA DEL ESTADO DEL PROYECTO: {$reporteFinal['FinalReport']['tecnica']}</td>
        </tr>
    </tbody>
</table>
EOD;
$tbl.="<p> </p><br>";

$tbl.= <<<EOD
<table border="1" style="font-size:small;width:100%" cellpadding="4">
    <tbody>    
        <tr style="text-align:justify">
            <td colspan="2">CUMPLIMIENTO DE OBLIGACIONES POR PARTE DE LOS BENEFICIARIOS: {$reporteFinal['FinalReport']['cumplimiento_obligaciones']}</td>
        </tr>
    </tbody>
</table>
EOD;
$tbl.="<p> </p><br>";

$tbl.= <<<EOD
<table border="1" style="font-size:small;width:100%" cellpadding="4">
    <tbody>    
        <tr style="text-align:justify">
            <td colspan="2">INCONVENIENTES PRESENTADOS Y/O PROCESOS DESARROLLADOS POR INCUMPLIMIENTO DE OBLIGACIONES: {$reporteFinal['FinalReport']['inconvenientes']}</td>
        </tr>
    </tbody>
</table>
EOD;
$tbl.="<p> </p><br>";

$tbl.= <<<EOD
<table border="1" style="font-size:small;width:100%" cellpadding="4">
    <tbody>    
        <tr style="text-align:justify">
            <td colspan="2">OBSERVACIONES GENERALES Y RECOMENDACIONES: {$reporteFinal['FinalReport']['generales']}</td>
        </tr>
    </tbody>
</table>
EOD;
$tbl.="<p> </p><br>";
$a = explode('-', $reporteFinal['FinalReport']['fecha_expedicion']);

$dia = $a[2];
$mes = $EnLetras->getMontName($reporteFinal['FinalReport']['fecha_expedicion']);
$anio = $a[0];

$tbl.="<p>Nota: Adjuntar los soportes necesarios. (Ultimo F17, Constancia de cierre de la cuenta, Acta de rendición de cuentas a los beneficiarios)</p><br>";
$tbl.="<p>Para Constancia firman los miembros del Equipo Técnico de Vigilancia de la Inversión a los {$dia} días del mes de {$mes} de {$anio}.</p><br>";

$tbl.="<br>";
$tbl.="<br>";
$tbl.="<br>";

$tbl.="<p> </p><br>";
$tbl.= <<<EOD
<table border="0" style="font-size:small;width:100%" cellpadding="2">
    <tbody>    
        <tr style="text-align:justify">
            <td colspan="2">_____________________________</td>
            <td colspan="2">_____________________________</td>
        </tr>
        <tr style="text-align:justify">
            <td colspan="2">Director Territorial</td>
            <td colspan="2">Coordinador Técnico </td>
        </tr>
        <tr style="text-align:justify">
            <td colspan="2">Nombre:</td>
            <td colspan="2">Nombre:</td>
        </tr>
    </tbody>
</table>
EOD;
$tbl.="<p> </p><br>";
$tbl.=<<<EOD
<table border="0" style="font-size:small;width:100%" cellpadding="2">
    <tbody>    
        <tr style="text-align:justify">
            <td colspan="2">_____________________________</td>
        </tr>
        <tr style="text-align:justify">
            <td colspan="2">Representante de los Beneficiarios</td>
        </tr>
        <tr style="text-align:justify">
            <td colspan="2">Nombre</td>
        </tr>
    </tbody>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
$pdf->Output('ReporteFinal-'.date("Y-m-d").'.pdf', 'I');
?>