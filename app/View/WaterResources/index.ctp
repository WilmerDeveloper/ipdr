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
            <th><?php echo $this->Paginator->sort('WaterResource.recurso_tipo', 'Fuente'); ?></th>
            <th><?php echo $this->Paginator->sort('WaterResource.recurso_nombre', 'Nombre'); ?></th>
            <th><?php echo $this->Paginator->sort('WaterResource.disponibilidad', 'Disponibilidad'); ?></th>
            <th><?php echo $this->Paginator->sort('WaterResource.estado', 'Estado de conservación'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($WaterResources as $WaterResource): ?>
            <tr>
                <td><?php echo $WaterResource['WaterResource']['recurso_tipo']; ?></td>
                <td><?php echo $WaterResource['WaterResource']['recurso_nombre']; ?></td>
                <td><?php echo $WaterResource['WaterResource']['estado']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'WaterResources', 'action' => 'edit', $WaterResource["WaterResource"]["id"]), array('update' => 'hidricos', 'indicator' => 'loading')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'WaterResources', 'action' => 'delete', $WaterResource["WaterResource"]["id"], $property_id), array('update' => 'hidricos', 'indicator' => 'loading'),'¿Realmente desea borrar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'WaterResources', 'action' => 'add',$property_id), array('update' => 'hidricos', 'indicator' => 'loading')); ?>