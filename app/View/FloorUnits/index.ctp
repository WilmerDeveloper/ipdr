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
            <th><?php echo $this->Paginator->sort('FloorUnit.textura', 'Textura'); ?></th>
            <th><?php echo $this->Paginator->sort('FloorUnit.horizonte', 'Horizonte (cm)'); ?></th>
            <th><?php echo $this->Paginator->sort('FloorUnit.pendiente', 'Pendiente'); ?></th>
            <th><?php echo $this->Paginator->sort('FloorUnit.color', 'Color'); ?></th>
            <th><?php echo $this->Paginator->sort('FloorUnit.pedregosidad', 'Pedregosidad'); ?></th>
            <th><?php echo $this->Paginator->sort('FloorUnit.ph', 'pH'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($FloorUnits as $FloorUnit): ?>
            <tr>
                <td><?php echo $FloorUnit['FloorUnit']['textura']; ?></td>
                <td><?php echo $FloorUnit['FloorUnit']['horizonte']; ?></td>
                <td><?php echo $FloorUnit['FloorUnit']['pendiente']; ?></td>
                <td><?php echo $FloorUnit['FloorUnit']['color']; ?></td>
                <td><?php echo $FloorUnit['FloorUnit']['pedregosidad']; ?></td>
                <td><?php echo $FloorUnit['FloorUnit']['ph']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'FloorUnits', 'action' => 'edit', $FloorUnit["FloorUnit"]["id"]), array('update' => 'unidad', 'indicator' => 'loading')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'FloorUnits', 'action' => 'delete', $FloorUnit["FloorUnit"]["id"], $property_id), array('update' => 'unidad', 'indicator' => 'loading'),'¿Realmente desea borrar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'FloorUnits', 'action' => 'add',$property_id), array('update' => 'unidad', 'indicator' => 'loading')); ?>