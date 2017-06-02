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
            <th><?php echo $this->Paginator->sort('Producer.id', 'Id'); ?></th>
            <th><?php echo $this->Paginator->sort('Producer.nombre', 'Nombre del productor'); ?></th>
            <th><?php echo $this->Paginator->sort('Producer.tipo_identificacion', 'Tipo identificación'); ?></th>
            <th><?php echo $this->Paginator->sort('Producer.numero_identificacion', 'Número de identificación'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Producers as $Producer): ?>
            <tr>
                <td><?php echo $Producer['Producer']['id']; ?></td>
                <td><?php echo $Producer['Producer']['nombre']; ?></td>
                <td><?php echo $Producer['Producer']['tipo_identificacion']; ?></td>
                <td><?php echo $Producer['Producer']['numero_identificacion']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Producers', 'action' => 'edit', $Producer["Producer"]["id"]), array('update' => 'caracterizacion', 'indicator' => 'loading')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Producers', 'action' => 'delete', $Producer["Producer"]["id"], $property_id), array('update' => 'caracterizacion', 'indicator' => 'loading'), '¿DEsea eliminar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php
if (count($Producers) == 0)
    echo $this->Ajax->link('Adicionar', array('controller' => 'Producers', 'action' => 'add', $property_id), array('update' => 'caracterizacion', 'indicator' => 'loading', 'complete' => 'formularioAjax()')); ?>