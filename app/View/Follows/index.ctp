<?php

$rutaArchivo = "files" . "/PlanesInversion";
?>
<table id="tabla">
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Follows as $Follow): ?>
        <tr>
            <td><?php echo $Follow['Follow']['observaciones'] ?></td>
            <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Follows', 'action' => 'edit', $Follow['Follow']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>
            <td><?php
                $rutaDocumento = APP . "webroot" . "/" . "files" . "/PlanesInversion/PlanInversion-".$Follow['Follow']['id'];
                if (file_exists( $rutaDocumento. ".pdf")):
                    ?>
                <a href="<?php echo $rutaArchivo . "/" . "PlanInversion-".$Follow['Follow']['id'].".pdf" ?>" target="blank" class="acciones" >Soporte</a>
                <?php else: echo "Falta soporte" ?> 
                <?php endif; ?></td>
            <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Follows', 'action' => 'delete', $Follow['Follow']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'), '¿Esta seguro que desea borrar este registro?'); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br><br>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>   
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Proyects', 'action' => 'seguimiento'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
            <td><?php echo $this->Ajax->link('Adicionar', array('controller' => 'Follows', 'action' => 'add', $proyect_id), array('update' => 'content', 'class' => 'acciones', 'indicator' => 'loading'), '¿Desea adicionar un nuevo registro?'); ?></td>
        </tr>
    </tbody>
</table>