<?php
$rutaArchivo = "files" . "/ExtractosBancariosComites";
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
        <?php foreach ($Extracts as $Extract): ?>
            <tr>
                <td><?php echo $Extract['Extract']['observaciones'] ?></td>
                <td><?php echo '$' . number_format($Extract['Extract']['saldo'], 0, ',', '.') ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Extracts', 'action' => 'edit', $Extract['Extract']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>
                <td><?php
                    $rutaDocumento = APP . "webroot" . "/" . "files" . "/ExtractosBancariosComites/ExtractoBancarioComite-" . $Extract['Extract']['id'];
                    if (file_exists($rutaDocumento . ".pdf")):
                        ?>
                        <a href="<?php echo $rutaArchivo . "/" . "ExtractoBancarioComite-" . $Extract['Extract']['id'] . ".pdf" ?>" target="blank" class="acciones" >Soporte</a>
                    <?php else: echo "Falta soporte" ?> 
                    <?php endif; ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Extracts', 'action' => 'delete', $Extract['Extract']['id'], $Extract['Extract']['proyect_id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'), '¿Esta seguro que desea borrar este registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br><br>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>   
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Proyects', 'action' => 'seguimiento'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
            <td><?php echo $this->Ajax->link('Adicionar', array('controller' => 'Extracts', 'action' => 'add', $proyect_id), array('update' => 'content', 'class' => 'acciones', 'indicator' => 'loading'), '¿Desea adicionar un nuevo registro?'); ?></td>
        </tr>
    </tbody>
</table>