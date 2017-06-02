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
            <th><?php echo $this->Paginator->sort('MonitoringActivity.id', 'Id'); ?></th>
            <th><?php echo $this->Paginator->sort('MonitoringActivity.nombre', 'Nombre'); ?></th>
            <th><?php echo $this->Paginator->sort('MonitoringActivity.tipo', 'Tipo'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($MonitoringActivities as $MonitoringActivity): ?>
            <tr>
                <td><?php echo $MonitoringActivity['MonitoringActivity']['id']; ?></td>
                <td><?php echo $MonitoringActivity['MonitoringActivity']['nombre']; ?></td>
                <td><?php echo $MonitoringActivity['MonitoringActivity']['tipo']; ?></td>
                <td><?php echo $this->Ajax->link('editar', array('controller' => 'MonitoringActivities', 'action' => 'edit', $MonitoringActivity["MonitoringActivity"]["id"]), array('update' => 'content', 'indicator' => 'loading' ,'complete'=>'formularioAjax()')); ?></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'MonitoringActivities', 'action' => 'add'), array('update' => 'content', 'indicator' => 'loading','complete'=>'formularioAjax()')); ?>
