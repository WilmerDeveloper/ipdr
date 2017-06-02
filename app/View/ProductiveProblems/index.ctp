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
            <th><?php echo $this->Paginator->sort('ProductiveProblem.id', 'Id'); ?></th>
            <th><?php echo $this->Paginator->sort('ProductiveProblem.tipo', 'Problema'); ?></th>
            <th><?php echo $this->Paginator->sort('ProductiveProblem.valor', 'Valor'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($ProductiveProblems as $ProductiveProblem): ?>
            <tr>
                <td><?php echo $ProductiveProblem['ProductiveProblem']['id']; ?></td>
                <td><?php echo $ProductiveProblem['ProductiveProblem']['tipo']; ?></td>
                <td><?php echo $ProductiveProblem['ProductiveProblem']['valor']; ?></td>
                <td><?php echo $this->Ajax->link('editar', array('controller' => 'ProductiveProblems', 'action' => 'edit', $ProductiveProblem["ProductiveProblem"]["id"]), array('update' => 'problemas', 'indicator' => 'loading')); ?></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'ProductiveProblems', 'action' => 'add',$productive_poll_id), array('update' => 'problemas', 'indicator' => 'loading')); ?>
