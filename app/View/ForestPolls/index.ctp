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
            <th><?php echo $this->Paginator->sort('ProductiveActivity.nombre', 'Actividad'); ?></th>
            <th><?php echo $this->Paginator->sort('ForestPoll.area', 'Área'); ?></th>
            <th><?php echo $this->Paginator->sort('ForestPoll.observaciones', 'Observaciones'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ForestPolls as $ForestPoll): ?>
            <tr>
                <td><?php echo $ForestPoll['ProductiveActivity']['nombre']; ?></td>
                <td><?php echo $ForestPoll['ForestPoll']['area']; ?></td>
                <td><?php echo $ForestPoll['ForestPoll']['observaciones']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'ForestPolls', 'action' => 'edit', $ForestPoll["ForestPoll"]["id"]), array('update' => 'forestal', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'ForestPolls', 'action' => 'delete', $ForestPoll["ForestPoll"]["id"], $plot_id), array('update' => 'forestal', 'indicator' => 'loading', 'class' => 'acciones'), '¿Desea eliminar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'ForestPolls', 'action' => 'add', $plot_id), array('update' => 'forestal', 'indicator' => 'loading', 'class' => 'acciones')); ?>
