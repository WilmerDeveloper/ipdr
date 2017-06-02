<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#content', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table style="font-size: smaller">
    <thead>
        <tr>

            <th><?php echo $this->Paginator->sort('Marketing.tipo', 'Tipo de canal'); ?></th>
            <th><?php echo $this->Paginator->sort('Marketing.nombre_canal', 'Nombre del canal'); ?></th>
            <th><?php echo $this->Paginator->sort('ProductiveActivity.nombre', 'Producto'); ?></th>
            <th><?php echo $this->Paginator->sort('Marketing.variedad', 'Variedad'); ?></th>
            <th><?php echo $this->Paginator->sort('Marketing.calidad', 'Calidad'); ?></th>
            <th><?php echo $this->Paginator->sort('Marketing.unidad', 'Unidad'); ?></th>
            <th><?php echo $this->Paginator->sort('Marketing.cantidad_unidad', 'Cantidad Unidad/Año'); ?></th>
            <th><?php echo $this->Paginator->sort('Marketing.precio_promedio', 'Precio promedio unidad'); ?></th>
            <th></th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($Marketings as $Marketing): ?>
            <tr>

                <td><?php echo $Marketing['Marketing']['tipo']; ?></td>
                <td><?php echo $Marketing['Marketing']['nombre_canal']; ?></td>
                <td><?php echo $Marketing['ProductiveActivity']['nombre']; ?></td>
                <td><?php echo $Marketing['Marketing']['variedad']; ?></td>
                <td><?php echo $Marketing['Marketing']['calidad']; ?></td>
                <td><?php echo $Marketing['Marketing']['unidad']; ?></td>
                <td><?php echo $Marketing['Marketing']['cantidad_unidad']; ?></td>
                <td><?php echo $Marketing['Marketing']['precio_promedio']; ?></td>

                <td>
                    <?php echo $this->Ajax->link('Editar', array('controller' => 'Marketings', 'action' => 'edit', $Marketing["Marketing"]["id"]), array('update' => 'comercializacion', 'class' => 'acciones', 'indicator' => 'loading')); ?>
                    <br>
                    <br><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Marketings', 'action' => 'delete', $Marketing["Marketing"]["id"],$productive_baseline_id), array('update' => 'comercializacion', 'class' => 'acciones', 'indicator' => 'loading'), '¿DEsea eliminar el registro?'); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Marketings', 'action' => 'add', $productive_baseline_id), array('update' => 'comercializacion', 'class' => 'acciones', 'indicator' => 'loading')); ?>
