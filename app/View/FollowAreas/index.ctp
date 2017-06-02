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
            <th><?php echo $this->Paginator->sort('FollowArea.area', 'Área'); ?></th>
            <th><?php echo $this->Paginator->sort('FollowArea.observaciones', 'Observaciones'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($FollowAreas as $FollowArea): ?>
            <tr>
                <td><?php echo $FollowArea['ProductiveActivity']['nombre']; ?></td>
                <td><?php echo $FollowArea['FollowArea']['area']; ?></td>
                <td><?php echo $FollowArea['FollowArea']['observaciones']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'FollowAreas', 'action' => 'edit', $FollowArea["FollowArea"]["id"]), array('update' => 'areas', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'FollowAreas', 'action' => 'delete', $FollowArea["FollowArea"]["id"], $plot_id), array('update' => 'areas', 'indicator' => 'loading', 'class' => 'acciones'), '¿Desea eliminar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'FollowAreas', 'action' => 'add', $plot_id), array('update' => 'areas', 'indicator' => 'loading', 'class' => 'acciones')); ?>
