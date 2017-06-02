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
            <th><?php echo $this->Paginator->sort('ProductiveArea.orden', 'Orden'); ?></th>
            <th><?php echo $this->Paginator->sort('ProductiveActivity.nombre', 'Actividad'); ?></th>
            <th><?php echo $this->Paginator->sort('ProductiveArea.area', 'Area'); ?></th>
            <th><?php echo $this->Paginator->sort('ProductiveArea.unidad', 'Unidad'); ?></th>
            <th><?php echo $this->Paginator->sort('ProductiveArea.densidad', 'Densidad'); ?></th>
            <th><?php echo $this->Paginator->sort('ProductiveArea.volumen_producion', 'Volumen total de producción por ciclo'); ?></th>
            <th><?php echo $this->Paginator->sort('ProductiveArea.unidad_produccion', 'Unidad producción'); ?></th>
            <th><?php echo $this->Paginator->sort('ProductiveArea.cosechas', 'Cosechas'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($ProductiveAreas as $ProductiveArea): ?>
            <tr>
                <td><?php echo $ProductiveArea['ProductiveArea']['orden']; ?></td>
                <td><?php echo $ProductiveArea['ProductiveActivity']['nombre']; ?></td>
                <td><?php echo $ProductiveArea['ProductiveArea']['area']; ?></td>
                <td><?php echo $ProductiveArea['ProductiveArea']['unidad']; ?></td>
                <td><?php echo $ProductiveArea['ProductiveArea']['densidad']; ?></td>
                <td><?php echo $ProductiveArea['ProductiveArea']['volumen_producion']; ?></td>
                <td><?php echo $ProductiveArea['ProductiveArea']['unidad_produccion']; ?></td>
                <td><?php echo $ProductiveArea['ProductiveArea']['cosechas']; ?></td>
                <td><?php echo $this->Ajax->link('editar', array('controller' => 'ProductiveAreas', 'action' => 'edit', $ProductiveArea["ProductiveArea"]["id"]), array('update' => 'areas', 'indicator' => 'loading')); ?></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'ProductiveAreas', 'action' => 'add',$productive_poll_id), array('update' => 'areas', 'indicator' => 'loading')); ?>
