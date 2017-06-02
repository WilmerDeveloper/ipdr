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
            <th><?php echo $this->Paginator->sort('Lender.id', 'Id'); ?></th>
            <th><?php echo $this->Paginator->sort('Lender.nombre', 'Nombre'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($Lenders as $Lender): ?>
            <tr>
                <td><?php echo $Lender['Lender']['id']; ?></td>
                <td><?php echo $Lender['Lender']['nombre']; ?></td>
                <td><?php echo $this->Ajax->link('editar', array('controller' => 'Lenders', 'action' => 'edit', $Lender["Lender"]["id"]), array('update' => 'institucion', 'indicator' => 'loading')); ?></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Lenders', 'action' => 'add', $productive_poll_id), array('update' => 'institucion', 'indicator' => 'loading')); ?>
