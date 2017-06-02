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
            <th><?php echo $this->Paginator->sort('Property', 'Nombre'); ?></th>
            <th><?php echo $this->Paginator->sort('LandUse.nombre', 'Uso'); ?></th>
            <th><?php echo $this->Paginator->sort('LandUse.unidad', 'Unidad'); ?></th>
            <th><?php echo $this->Paginator->sort('LandUse.area', 'Área'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($LandUses as $LandUse): ?>
            <tr>
                <td><?php echo $LandUse['Property']['nombre']; ?></td>
                <td><?php echo $LandUse['LandUse']['nombre']; ?></td>
                <td><?php echo $LandUse['LandUse']['unidad']; ?></td>
                <td><?php echo $LandUse['LandUse']['area']; ?></td>
                <td><?php echo $this->Ajax->link('editar', array('controller' => 'LandUses', 'action' => 'edit', $LandUse["LandUse"]["id"]), array('update' => 'usos_suelo', 'indicator' => 'loading','complete'=>'formularioAjax()')); ?></td>
                <td><?php echo $this->Ajax->link('eliminar', array('controller' => 'LandUses', 'action' => 'delete', $LandUse["LandUse"]["id"],$property_id), array('update' => 'usos_suelo', 'indicator' => 'loading','complete'=>'formularioAjax()'),'¿Desea eliminar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'LandUses', 'action' => 'add',$property_id), array('update' => 'usos_suelo', 'indicator' => 'loading')); ?>
