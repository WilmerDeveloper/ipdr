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
            <th><?php echo $this->Paginator->sort('Device.id', 'Id'); ?></th>
            <th><?php echo $this->Paginator->sort('Device.name', 'Tipo'); ?></th>
            <th><?php echo $this->Paginator->sort('Device.cantidad', 'Cantidad'); ?></th>
            <th><?php echo $this->Paginator->sort('Device.cantidad', 'Otro'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($Devices as $Device): ?>
            <tr>
                <td><?php echo $Device['Device']['id']; ?></td>
                <td><?php echo $Device['Device']['name']; ?></td>
                <td><?php echo $Device['Device']['cantidad']; ?></td>
                <td><?php echo $Device['Device']['otro']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Devices', 'action' => 'edit', $Device["Device"]["id"]), array('update' => 'devices', 'indicator' => 'loading')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Devices', 'action' => 'delete', $Device["Device"]["id"],$home_id), array('update' => 'devices', 'indicator' => 'loading'),'¿Ralmente desea borrar el registro?'); ?></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Devices', 'action' => 'add',$home_id), array('update' => 'devices', 'indicator' => 'loading')); ?>
