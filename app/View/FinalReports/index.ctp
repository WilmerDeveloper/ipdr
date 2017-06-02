<?php

$rutaArchivo = "files" . "/ReportesFinales";
?>
<table id="tabla">
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($FinalReports as $FinalReport): ?>
        <tr>
            <td><?php echo $FinalReport['FinalReport']['generales'] ?></td>
            <td><?php
                    $rutaDocumento = APP . "webroot" . "/" . "files" . "/ReportesFinales/ReporteFinal-" . $FinalReport['FinalReport']['id'];
                    if (file_exists($rutaDocumento . ".pdf")):
                        ?>
                <a href="<?php echo $rutaArchivo . "/" . "ReporteFinal-" . $FinalReport['FinalReport']['id'] . ".pdf" ?>" target="blank" class="acciones" >Formato F21-GI-IPDR</a>
                    <?php else: echo "Falta Archivo formato F21-GI-IPDR" ?> 
                    <?php endif; ?></td>
            <td><?php
                    $rutaDocumento = APP . "webroot" . "/" . "files" . "/ReportesFinales/CierreCuenta-" . $FinalReport['FinalReport']['id'];
                    if (file_exists($rutaDocumento . ".pdf")):
                        ?>
                <a href="<?php echo $rutaArchivo . "/" . "CierreCuenta-" . $FinalReport['FinalReport']['id'] . ".pdf" ?>" target="blank" class="acciones" >Soporte cierre cuenta</a>
                    <?php else: echo "Falta Archivo certificado cierre de cuenta" ?> 
                    <?php endif; ?></td>
            <td><?php echo $this->Html->link('Imprimir', array('controllers' => 'FinalReports', 'action' => 'print_letter', $FinalReport['FinalReport']['id']), array('target' => '_blank', 'class' => 'acciones')) ?>
                <br/>       
                <br/> </td>
            <td><?php echo $this->Ajax->link('Editar', array('controller' => 'FinalReports', 'action' => 'edit', $FinalReport['FinalReport']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>
            <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'FinalReports', 'action' => 'delete', $FinalReport['FinalReport']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'), '¿Esta seguro que desea borrar este registro?'); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br><br>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>   
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Proyects', 'action' => 'seguimiento'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
            <td><?php echo $this->Ajax->link('Adicionar', array('controller' => 'FinalReports', 'action' => 'add', $proyect_id), array('update' => 'content', 'class' => 'acciones', 'indicator' => 'loading'), '¿Desea adicionar un nuevo registro?'); ?></td>
        </tr>
    </tbody>
</table>
