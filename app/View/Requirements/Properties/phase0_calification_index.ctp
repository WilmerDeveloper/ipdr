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
            <th><?php echo $this->Paginator->sort('Property.id', 'Id'); ?></th>
            <th><?php echo $this->Paginator->sort('Property.nombre', 'Predio'); ?></th>
            <th><?php echo $this->Paginator->sort('Property.concepto_fase0', 'Concepto'); ?></th>
            <th><?php echo $this->Paginator->sort('Property.calificacion_fase0', 'Calificación'); ?></th>
            <th colspan="2"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Properties as $Property): ?>
            <tr>
                <td><?php echo $Property['Property']['id']; ?></td>
                <td><?php echo $Property['Property']['nombre']; ?></td>
                <td><?php echo $Property['Property']['concepto_fase0']; ?></td>
                <td><?php echo $Property['Property']['calificacion_fase0']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Properties', 'action' => 'edit_phase0', $Property["Property"]["id"]), array('update' => 'calificacion', 'indicator' => 'loading', 'complete' => 'formularioAjax()', 'class' => 'acciones')); ?></td>
                <td><?php echo $this->Html->link('Listado', array('controller' => 'Properties', 'action' => 'print_list', $Property["Property"]["id"]), array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>