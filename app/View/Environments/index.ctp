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
            <th><?php echo $this->Paginator->sort('Environment.inundacion_area', 'Área de inundación'); ?></th>
            <th><?php echo $this->Paginator->sort('Environment.inundacion_periodo', 'Periodo de inundación'); ?></th>
            <th><?php echo $this->Paginator->sort('Environment.derrumbe_area', 'Área de riesgo de derrumbre'); ?></th>
            <th><?php echo $this->Paginator->sort('Environment.derrumbe_ubicacion', 'Ubicación de derrumbre'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Environments as $Environment): ?>
            <tr>
                <td><?php echo $Environment['Environment']['inundacion_area']; ?></td>
                <td><?php echo $Environment['Environment']['inundacion_periodo']; ?></td>
                <td><?php echo $Environment['Environment']['derrumbe_area']; ?></td>
                <td><?php echo $Environment['Environment']['derrumbe_ubicacion']; ?></td>
                <td><?php echo $this->Ajax->link('editar', array('controller' => 'Environments', 'action' => 'edit', $Environment["Environment"]["id"]), array('update' => 'adicional', 'indicator' => 'loading')); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php
if(empty($Environments))
echo $this->Ajax->link('Adicionar', array('controller' => 'Environments', 'action' => 'add',$property_id), array('update' => 'adicional', 'indicator' => 'loading')); ?>