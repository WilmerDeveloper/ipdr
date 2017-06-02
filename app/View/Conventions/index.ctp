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
            <th><?php echo $this->Paginator->sort('Convention.tipo', 'Tipo'); ?></th>
            <th><?php echo $this->Paginator->sort('Convention.institucion', 'Institución'); ?></th>

            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($Conventions as $Convention): ?>
            <tr>
                <td><?php echo $Convention['Convention']['tipo']; ?></td>
                <td><?php echo $Convention['Convention']['institucion']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Conventions', 'action' => 'edit', $Convention["Convention"]["id"]), array('update' => 'convenios', 'indicator' => 'loading')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Conventions', 'action' => 'delete', $Convention["Convention"]["id"],$asociation_id), array('update' => 'convenios', 'indicator' => 'loading'),'¿Realmente desea borrar el registro?'); ?></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Conventions', 'action' => 'add', $asociation_id), array('update' => 'convenios', 'indicator' => 'loading')); ?>
