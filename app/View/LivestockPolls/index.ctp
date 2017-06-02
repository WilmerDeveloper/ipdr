<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#pecuario', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table>
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('ProductiveActivity.nombre', 'Linea'); ?></th>
            <th><?php echo $this->Paginator->sort('LivestockPoll.cantidad', 'Cantidad'); ?></th>
            <th><?php echo $this->Paginator->sort('LivestockPoll.raza', 'Raza'); ?></th>
            <th><?php echo $this->Paginator->sort('LivestockPoll.observaciones', 'Observaciones'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($LivestockPolls as $LivestockPoll): ?>
            <tr>
                <td><?php echo $LivestockPoll['ProductiveActivity']['nombre']; ?></td>
                <td><?php echo $LivestockPoll['LivestockPoll']['cantidad']; ?></td>
                <td><?php echo $LivestockPoll['LivestockPoll']['raza']; ?></td>
                <td><?php echo $LivestockPoll['LivestockPoll']['observaciones']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'LivestockPolls', 'action' => 'edit', $LivestockPoll["LivestockPoll"]["id"]), array('update' => 'pecuario', 'indicator' => 'loading', 'class'=>'acciones')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'LivestockPolls', 'action' => 'delete', $LivestockPoll["LivestockPoll"]["id"], $plot_poll_id), array('update' => 'pecuario', 'indicator' => 'loading', 'class'=>'acciones'), '¿Desea borrar el registro?'); ?></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'LivestockPolls', 'action' => 'add', $plot_poll_id), array('update' => 'pecuario', 'indicator' => 'loading', 'class'=>'acciones')); ?>
