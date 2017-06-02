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
            <th><?php echo $this->Paginator->sort('WaterSource.id', 'Id'); ?></th>
            <th><?php echo $this->Paginator->sort('WaterSource.tipo', 'Tipo'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($WaterSources as $WaterSource): ?>
            <tr>
                <td><?php echo $WaterSource['WaterSource']['id']; ?></td>
                <td><?php echo $WaterSource['WaterSource']['tipo']; ?></td>
               
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'WaterSources', 'action' => 'edit', $WaterSource["WaterSource"]["id"]), array('update' => 'fuentes', 'indicator' => 'loading')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'WaterSources', 'action' => 'delete', $WaterSource["WaterSource"]["id"],$home_id), array('update' => 'fuentes', 'indicator' => 'loading'),'¿Ralmente desea borrar el registro?'); ?></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'WaterSources', 'action' => 'add',$home_id), array('update' => 'fuentes', 'indicator' => 'loading')); ?>
