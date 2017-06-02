<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#compromisos', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table>
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('Liability.compromiso', 'Compromiso'); ?></th>
            <th><?php echo $this->Paginator->sort('Liability.fecha_establecida', 'fecha establecida'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Liabilities as $Liability): ?>
            <tr>
                <td><?php echo $Liability['Liability']['compromiso']; ?></td>
                <td><?php echo $Liability['Liability']['fecha_establecida']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Liabilities', 'action' => 'edit', $Liability["Liability"]["id"]), array('update' => 'compromisos', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Liabilities', 'action' => 'delete', $Liability["Liability"]["id"], $plot_poll_id), array('update' => 'compromisos', 'indicator' => 'loading', 'class' => 'acciones'), '¿Desea eliminar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Liabilities', 'action' => 'add', $plot_poll_id), array('update' => 'compromisos', 'indicator' => 'loading', 'class' => 'acciones')); ?>