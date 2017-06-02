<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Requirements', 'action' => 'add'), array('update' => 'content', 'indicator' => 'loading','complete'=>'formularioAjax()')); ?>


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
            <th><?php echo $this->Paginator->sort('Requirement.id', 'Id'); ?></th>
            <th><?php echo $this->Paginator->sort('Requirement.nombre', 'Requisito'); ?></th>
            <th><?php echo $this->Paginator->sort('Requirement.tipo', 'Tipo'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($Requirements as $Requirement): ?>
            <tr>
                <td><?php echo $Requirement['Requirement']['id']; ?></td>
                <td><?php echo $Requirement['Requirement']['nombre']; ?></td>
                <td><?php echo $Requirement['Requirement']['tipo']; ?></td>
                <td><?php echo $this->Ajax->link('editar', array('controller' => 'Requirements', 'action' => 'edit', $Requirement["Requirement"]["id"]), array('update' => 'content', 'indicator' => 'loading','complete'=>'formularioAjax()')); ?></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Requirements', 'action' => 'add'), array('update' => 'content', 'indicator' => 'loading','complete'=>'formularioAjax()')); ?>
