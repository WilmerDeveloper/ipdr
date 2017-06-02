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
            <th><?php echo $this->Paginator->sort('InitialRequirement.id', 'ID'); ?></th>
            <th><?php echo $this->Paginator->sort('InitialRequirement.texto', 'Requisito'); ?></th>
            <th><?php echo $this->Paginator->sort('InitialRequirement.tipo', 'Tipo'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($InitialRequirements as $InitialRequirement): ?>
            <tr>
                <td><?php echo $InitialRequirement['InitialRequirement']['id']; ?></td>
                <td><?php echo $InitialRequirement['InitialRequirement']['texto']; ?></td>
                <td><?php echo $InitialRequirement['InitialRequirement']['tipo']; ?></td>
                <td><?php echo $this->Ajax->link('editar', array('controller' => 'InitialRequirements', 'action' => 'edit', $InitialRequirement["InitialRequirement"]["id"]), array('update' => 'content','complete'=>'formularioAjax()', 'indicator' => 'loading')); ?></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'InitialRequirements', 'action' => 'add',$call_id), array('update' => 'content', 'indicator' => 'loading' ,'complete'=>'formularioAjax()')); ?>
