<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#producto', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table>
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('Product.nombre', 'Producto'); ?></th>
            <th><?php echo $this->Paginator->sort('PlotProduction.cantidad', 'Cantidad'); ?></th>
            <th><?php echo $this->Paginator->sort('PlotProduction.unidad', 'Unidad'); ?></th>
            <th><?php echo $this->Paginator->sort('PlotProduction.valor', 'Valor'); ?></th>
          
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($PlotProductions as $PlotProduction): ?>
            <tr>
                <td><?php echo $PlotProduction['Product']['nombre']; ?></td>
                <td><?php echo $PlotProduction['PlotProduction']['cantidad']; ?></td>
                <td><?php echo $PlotProduction['PlotProduction']['unidad']; ?></td>
                <td><?php echo $PlotProduction['PlotProduction']['valor']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'PlotProductions', 'action' => 'edit', $PlotProduction["PlotProduction"]["id"]), array('update' => 'producto', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'PlotProductions', 'action' => 'delete', $PlotProduction["PlotProduction"]["id"], $plot_poll_id), array('update' => 'producto', 'indicator' => 'loading', 'class' => 'acciones'), '¿Desea eliminar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'PlotProductions', 'action' => 'add', $plot_poll_id), array('update' => 'producto', 'indicator' => 'loading', 'class' => 'acciones')); ?>
