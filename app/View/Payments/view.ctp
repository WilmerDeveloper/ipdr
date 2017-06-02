<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$polizacal = $this->data['Payment']['calificacion_poliza'];
$polizaobs = $this->data['Payment']['observacion_poliza'];
$aprobacioncal = $this->data['Payment']['calificacion_aprobacion'];
$aprobacionobs = $this->data['Payment']['observacion_aprobacion'];
$bancariacal = $this->data['Payment']['calificacion_bancaria'];
$bancariaobs = $this->data['Payment']['observacion_bancaria'];
$notical = $this->data['Payment']['calificacion_notificacion'];
$notiobs = $this->data['Payment']['observacion_notificacion'];
$podercal = $this->data['Payment']['calificacion_poder'];
$poderobs = $this->data['Payment']['observacion_poder'];
$sanical = $this->data['Payment']['calificacion_sanitario'];
$saniobs = $this->data['Payment']['observacion_sanitario'];
$riegocal = $this->data['Payment']['calificacion_riego'];
$riegoobs = $this->data['Payment']['observacion_riego'];
$teccal = $this->data['Payment']['calificacion_tecnico'];
$tecobs = $this->data['Payment']['observacion_tecnico'];
$global = $this->data['Payment']['calificacion_global'];
$valor = number_format($this->data['Payment']['valor_desembolsado'], 0, ',', '.');
$linkPoliza = "No se ha adjuntado archivo";
$linkApro = "No se ha adjuntado archivo";
$linkBank = "No se ha adjuntado archivo";
$linkNoti = "No se ha adjuntado archivo";
$linkPoder = "No se ha adjuntado archivo";
$linkSani = "No se ha adjuntado archivo";
$linkRiego = "No se ha adjuntado archivo";
$linkTec = "No se ha adjuntado archivo";
if (file_exists("../webroot/files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_poliza']) and $this->data['Payment']['adjunto_poliza'] != "") {
    $linkPoliza = "<a href='" . "files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_poliza'] . "' target='_blank' class='acciones'>Ver_poliza</a>";
}
if (file_exists("../webroot/files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_aprobacion']) and $this->data['Payment']['adjunto_aprobacion'] != "") {
    $linkApro = "<a href='" . "files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_aprobacion'] . "' target='_blank' class='acciones'>Ver_aprobacion</a>";
}
if (file_exists("../webroot/files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_bancaria']) and $this->data['Payment']['adjunto_bancaria'] != "") {
    $linkBank = "<a href='" . "files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_bancaria'] . "' target='_blank' class='acciones'>Certificación_bancaria</a>";
}
if (file_exists("../webroot/files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_notificacion']) and $this->data['Payment']['adjunto_notificacion'] != "") {
    $linkNoti = "<a href='" . "files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_notificacion'] . "' target='_blank' class='acciones'>Notificación</a>";
}
if (file_exists("../webroot/files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_poder']) and $this->data['Payment']['adjunto_poder'] != "") {
    $linkPoder = "<a href='" . "files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_poder'] . "' target='_blank' class='acciones'>Poder</a>";
}
if (file_exists("../webroot/files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_sanitario']) and $this->data['Payment']['adjunto_sanitario'] != "") {
    $linkSani = "<a href='" . "files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_sanitario'] . "' target='_blank' class='acciones'>Componente_sanitario</a>";
}
if (file_exists("../webroot/files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_distrito']) and $this->data['Payment']['adjunto_distrito'] != "") {
    $linkRiego = "<a href='" . "files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_distrito'] . "' target='_blank' class='acciones'>Distrito de riego</a>";
}
if (file_exists("../webroot/files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_tecnico']) and $this->data['Payment']['adjunto_tecnico'] != "") {
    $linkTec = "<a href='" . "files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_tecnico'] . "' target='_blank' class='acciones'>Revisión_equipo_técnico</a>";
}
$tabla = "<table border=\"1\" cellpadding=\"5\">
    <tbody>
        
        <tr>
            <td>Valor</td>
            <td>
            $ $valor
            </td>
            
        </tr>
        <tr>
            <td>Póliza calificación</td>
            <td>
            $polizacal
            </td>
            <td>
            $linkPoliza
            </td>
            <td>
            &nbsp;
            </td>
        </tr>
        <tr>
            <td>Póliza observación</td>
            <td>
            $polizaobs
            </td>
            <td>
            &nbsp;
            </td>
        </tr>
        
        <tr>
            <td>Aprobación de la Póliza calificación</td>
            <td>
            $aprobacioncal
            </td>
            <td>
            $linkApro
            </td>
        </tr>
        <tr>
            <td>Aprobación de la Póliza observación</td>
            <td>
            $aprobacionobs
            </td>
            <td>
            &nbsp;
            </td>
        </tr>
        
        <tr>
            <td>Calificación Certificación bancaria</td>
            <td>
            
            $bancariacal
            </td>
            <td>
            $linkBank
            </td>
        </tr>
        <tr>
            <td>Observaciones Certificación bancaria</td>
            <td>
            $bancariaobs
            </td>
            <td>
            &nbsp;
            </td>
        </tr>
        
        <tr>
            <td>Calificación Formato Notificación</td>
            <td>
            $notical
            </td>
            <td>
            $linkNoti
            </td>
        </tr>
        <tr>
            <td>Observaciones Formato Notificación</td>
            <td>
            $notiobs
            </td>
            <td>
            &nbsp;
            </td>
        </tr>
       
        <tr>
            <td>Calificación Poder</td>
            <td>
            $podercal
            </td>
            <td>
            $linkPoder
            </td>
        </tr>
        <tr>
            <td>Observaciones Poder</td>
            <td>
            $poderobs
            </td>
            <td>
            &nbsp;
            </td>
        </tr>
       
        <tr>
            <td>Calificación Componente sanitario</td>
            <td>
            $sanical
            </td>
            <td>
            $linkSani
            </td>
        </tr>
        <tr>
            <td>Observaciones Componente sanitario</td>
            <td>
            $saniobs
            </td>
            <td>
            &nbsp;
            </td>
        </tr>
        
        <tr>
            <td>Calificación Distrito de riego</td>
            <td>
            $riegocal
            </td>
            <td>
            $linkRiego
            </td>
        </tr>
        <tr>
            <td>Observaciones Distrito de riego</td>
            <td>
            $riegoobs
            </td>
            <td>
            &nbsp;
            </td>
        </tr>
       
        <tr>
            <td>Revisión equipo técnico</td>
            <td>
            $teccal
            </td>
            <td>
            $linkTec
            </td>
        </tr>
        <tr>
            <td>Revisión equipo técnico</td>
            <td>
            $tecobs
            </td>
            <td>
            &nbsp;
            </td>
        </tr>
        <tr>
            <td>Calificación global</td>
            <td>
               $global
            </td>
            <td>
            &nbsp;
            </td>
        </tr>
    </tbody>
</table>";





echo $tabla . "<br>";

echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'regresar')), array('controller' => 'payments', 'action' => 'index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false));
?>

