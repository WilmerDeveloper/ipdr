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
            <th><?php echo $this->Paginator->sort('Practice.id', 'Id'); ?></th>
            <th><?php echo $this->Paginator->sort('Practice.tipo', 'Práctica'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($Practices as $Practice): ?>
            <tr>
                <td><?php echo $Practice['Practice']['id']; ?></td>
                <td><?php echo $Practice['Practice']['tipo']; ?></td>
                <td><?php echo $this->Ajax->link('editar', array('controller' => 'Practices', 'action' => 'edit', $Practice["Practice"]["id"]), array('update' => 'practicas', 'indicator' => 'loading')); ?></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Practices', 'action' => 'add', $productive_poll_id), array('update' => 'practicas', 'indicator' => 'loading')); ?>
