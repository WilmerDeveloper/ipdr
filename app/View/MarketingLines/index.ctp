<div class="paging">
<?php
echo $this->Paginator->options(array('update' => '#content','evalScripts' => false));
echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
?>
</div>
<table>
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('MarketingLine.tipo_canal', 'Tipo de canal'); ?></th>
            <th><?php echo $this->Paginator->sort('MarketingLine.nombre_canal', 'Nombre del canal (empresa o ciudad)'); ?></th>
            <th><?php echo $this->Paginator->sort('ProductiveActivity.nombre', 'Producto'); ?></th>
            <th><?php echo $this->Paginator->sort('MarketingLine.variedad', 'Variedad'); ?></th>
            <th><?php echo $this->Paginator->sort('MarketingLine.calidad', 'Calidad'); ?></th>
            <th><?php echo $this->Paginator->sort('MarketingLine.unidad', 'Unidad'); ?></th>
            <th><?php echo $this->Paginator->sort('MarketingLine.unidades_anio', 'Cantidad Unidades/año'); ?></th>
            <th><?php echo $this->Paginator->sort('MarketingLine.precio_promedio_unidad', 'Precio promedio unidad'); ?></th>
            <th><?php echo $this->Paginator->sort('MarketingLine.entrega', 'Entrega'); ?></th>
            <th><?php echo $this->Paginator->sort('MarketingLine.precio_cosecha', 'Precio de Cosecha'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($MarketingLines as $MarketingLine): ?>
            <tr>
                <td><?php echo $MarketingLine['MarketingLine']['tipo_canal']; ?></td>
                <td><?php echo $MarketingLine['MarketingLine']['nombre_canal']; ?></td>
                <td><?php echo $MarketingLine['ProductiveActivity']['nombre']; ?></td>
                <td><?php echo $MarketingLine['MarketingLine']['variedad']; ?></td>
                <td><?php echo $MarketingLine['MarketingLine']['calidad']; ?></td>
                <td><?php echo $MarketingLine['MarketingLine']['unidad']; ?></td>
                <td><?php echo $MarketingLine['MarketingLine']['unidades_anio']; ?></td>
                <td><?php echo $MarketingLine['MarketingLine']['precio_promedio_unidad']; ?></td>
                <td><?php echo $MarketingLine['MarketingLine']['entrega']; ?></td>
                <td><?php echo $MarketingLine['MarketingLine']['precio_cosecha']; ?></td>
                <td><?php echo $this->Ajax->link('editar', array('controller' => 'MarketingLines', 'action' => 'edit', $MarketingLine["MarketingLine"]["id"]), array('update' => 'canales', 'indicator' => 'loading')); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'MarketingLines', 'action' => 'add', $productive_poll_id), array('update' => 'canales', 'indicator' => 'loading')); ?>
