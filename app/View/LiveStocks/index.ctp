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
            <th><?php echo $this->Paginator->sort('LiveStock.id', 'Id'); ?></th>
            <th><?php echo $this->Paginator->sort('LiveStock.tipo', 'Tipo'); ?></th>
            <th><?php echo $this->Paginator->sort('LiveStock.cantidad', 'Cantidad'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($LiveStocks as $LiveStock): ?>
            <tr>
                <td><?php echo $LiveStock['LiveStock']['id']; ?></td>
                <td><?php echo $LiveStock['LiveStock']['tipo']; ?></td>
                <td><?php echo $LiveStock['LiveStock']['cantidad']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'LiveStocks', 'action' => 'edit', $LiveStock["LiveStock"]["id"]), array('update' => 'livestocks', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'LiveStocks', 'action' => 'delete', $LiveStock["LiveStock"]["id"], $home_id), array('update' => 'livestocks', 'indicator' => 'loading', 'class' => 'acciones'), '¿Realmente desea borrar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'LiveStocks', 'action' => 'add', $home_id), array('update' => 'livestocks', 'indicator' => 'loading', 'class' => 'acciones')); ?>
