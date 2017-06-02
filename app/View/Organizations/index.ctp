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
            <th><?php echo $this->Paginator->sort('Organization.tipo', 'Tipo de organización'); ?></th>
            <th><?php echo $this->Paginator->sort('Organization.nombre', 'Nombre de organización'); ?></th>
            <th><?php echo $this->Paginator->sort('Organization.sigla', 'Sigla'); ?></th>
            <th><?php echo $this->Paginator->sort('Organization.tiempo', 'Tiempo de Constitución (en años)'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Organizations as $Organization): ?>
            <tr>
                <td><?php echo $Organization['Organization']['tipo']; ?></td>
                <td><?php echo $Organization['Organization']['nombre']; ?></td>
                <td><?php echo $Organization['Organization']['sigla']; ?></td>
                <td><?php echo $Organization['Organization']['tiempo']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Organizations', 'action' => 'edit', $Organization["Organization"]["id"]), array('update' => 'organizacion', 'indicator' => 'loading')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Organizations', 'action' => 'delete', $Organization["Organization"]["id"], $property_id), array('update' => 'organizacion', 'indicator' => 'loading'),'¿Realmente desea borrar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Organizations', 'action' => 'add',$property_id), array('update' => 'organizacion', 'indicator' => 'loading')); ?>