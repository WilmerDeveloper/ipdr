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
            <th><?php echo $this->Paginator->sort('Asset.id', 'Id'); ?></th>
            <th><?php echo $this->Paginator->sort('Asset.tipo', 'Tipo'); ?></th>
            <th><?php echo $this->Paginator->sort('Asset.tipo', 'Otro'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($Assets as $Asset): ?>
            <tr>
                <td><?php echo $Asset['Asset']['id']; ?></td>
                <td><?php echo $Asset['Asset']['tipo']; ?></td>
                <td><?php echo $Asset['Asset']['otro']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Assets', 'action' => 'edit', $Asset["Asset"]["id"]), array('update' => 'activos', 'indicator' => 'loading')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Assets', 'action' => 'delete', $Asset["Asset"]["id"],$home_id), array('update' => 'activos', 'indicator' => 'loading'),'¿Realmente desea borrar el registro?'); ?></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Assets', 'action' => 'add',$home_id), array('update' => 'activos', 'indicator' => 'loading')); ?>
