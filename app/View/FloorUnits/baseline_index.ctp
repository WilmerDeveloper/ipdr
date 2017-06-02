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
            <th><?php echo $this->Paginator->sort('FloorUnit.textura', 'Textura'); ?></th>
            
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($FloorUnits as $FloorUnit): ?>
            <tr>
                <td><?php echo $FloorUnit['FloorUnit']['textura']; ?></td>
               
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'FloorUnits', 'action' => 'baseline_edit', $FloorUnit["FloorUnit"]["id"]), array('update' => 'unidad', 'indicator' => 'loading')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'FloorUnits', 'action' => 'baseline_delete', $FloorUnit["FloorUnit"]["id"], $property_id), array('update' => 'unidad', 'indicator' => 'loading'),'¿Realmente desea borrar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'FloorUnits', 'action' => 'baseline_add',$property_id), array('update' => 'unidad', 'indicator' => 'loading')); ?>
<!--En el update flecha 