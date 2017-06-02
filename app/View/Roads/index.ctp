<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#content', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table>
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('Road.tipo', 'Tipo de vía de acceso'); ?></th>
            <th><?php echo $this->Paginator->sort('Road.estado', 'Estado de vía de acceso'); ?></th>
            <th><?php echo $this->Paginator->sort('Road.distancia', 'Distancia en Kilómetros de las vías de acceso'); ?></th>
            <th><?php echo $this->Paginator->sort('Road.descripcion', 'Descripción de la vía de acceso'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Roads as $Road): ?>
            <tr>
                <td><?php echo $Road['Road']['tipo']; ?></td>
                <td><?php echo $Road['Road']['estado']; ?></td>
                <td><?php echo $Road['Road']['distancia']; ?></td>
                <td><?php echo $Road['Road']['descripcion']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Roads', 'action' => 'edit', $Road["Road"]["id"]), array('update' => 'roads', 'indicator' => 'loading')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Roads', 'action' => 'delete', $Road["Road"]["id"], $property_id), array('update' => 'roads', 'indicator' => 'loading'),'¿Realmente desea borrar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Roads', 'action' => 'add', $property_id), array('update' => 'roads', 'indicator' => 'loading')); ?>