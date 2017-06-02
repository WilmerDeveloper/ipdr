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
            <th><?php echo $this->Paginator->sort('Activity.actividad', 'Tipo de actividad'); ?></th>
            <th><?php echo $this->Paginator->sort('Activity.actividad_realizacion', 'Realización'); ?></th>
            <th><?php echo $this->Paginator->sort('Activity.frecuencia', 'Frecuencia'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Activities as $Activity): ?>
            <tr>
                <td><?php echo $Activity['Activity']['actividad']; ?></td>
                <td><?php echo $Activity['Activity']['actividad_realizacion']; ?></td>
                <td><?php echo $Activity['Activity']['frecuencia']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Activities', 'action' => 'edit', $Activity["Activity"]["id"]), array('update' => 'actividad', 'indicator' => 'loading')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Activities', 'action' => 'delete', $Activity["Activity"]["id"], $property_id), array('update' => 'actividad', 'indicator' => 'loading'),'¿Realmente desea borrar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Activities', 'action' => 'add',$property_id), array('update' => 'actividad', 'indicator' => 'loading')); ?>
