<div class="paging">
<?php
echo $this->Paginator->options(array('update' => '#content','evalScripts' => false));
echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
?>
</div>
</div>
<table>
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('Productiveactivity.nombre', 'Producto'); ?></th>
            <th><?php echo $this->Paginator->sort('Consumption.consumo_estimado', 'Consumo estimado/año'); ?></th>
            <th><?php echo $this->Paginator->sort('Consumption.unidad_medida', 'Unidad de medida'); ?></th>
            <th><?php echo $this->Paginator->sort('Consumption.porcentaje_cosecha', '% de Cosecha Utilizado'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Consumptions as $Consumption): ?>
            <tr>
                <td><?php echo $Consumption['ProductiveActivity']['nombre']; ?></td>
                <td><?php echo $Consumption['Consumption']['consumo_estimado']; ?></td>
                <td><?php echo $Consumption['Consumption']['unidad_medida']; ?></td>
                <td><?php echo $Consumption['Consumption']['porcentaje_cosecha']; ?></td>

                <td><?php echo $this->Ajax->link('editar', array('controller' => 'Consumptions', 'action' => 'edit', $Consumption["Consumption"]["id"]), array('update' => 'consumo', 'indicator' => 'loading')); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Consumptions', 'action' => 'add', $productive_poll_id), array('update' => 'consumo', 'indicator' => 'loading')); ?>
