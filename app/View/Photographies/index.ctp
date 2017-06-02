<h2>Listado de fotografías</h2>
<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#content', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    $cont = 1;
    ?>
</div>
<table>
    <thead>
        <tr>
            <th></th>
            <th>Comentario</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Photographies as $Photography): ?>
            <tr>
                <td><?php
        echo $cont;
        $cont++
            ?></td>
                <td><?php echo $Photography['Photography']['comentario']; ?></td>
                <td><?php
                if (file_exists("../webroot/files/Fotografias/" . $Photography['Photography']['archivo']) and $Photography['Photography']['archivo'] != "")
                    echo $this->Html->link('Archivo', "../files/Fotografias/" . $Photography['Photography']['archivo'], array('target' => '_blank', 'indicator' => 'loading', 'class' => 'acciones')); ?>
                </td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Photographies', 'action' => 'edit', $Photography["Photography"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones', 'complete' => 'formularioAjax()')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Photographies', 'action' => 'delete', $Photography["Photography"]["id"], $visit_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'), '¿Desea eliminar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<br>
<table style="width: 400px" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>  
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Visits', 'action' => 'index', $visit_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
            <td><?php echo $this->Ajax->link('Adicionar_fotografía', array('controller' => 'Photographies', 'action' => 'add', $visit_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones', 'complete' => 'formularioAjax()')); ?></td>
        </tr>
    </tbody>
</table>
<br>