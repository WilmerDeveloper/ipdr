<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#content', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table>
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('Transformation.id', 'Id'); ?></th>
            <th><?php echo $this->Paginator->sort('Transformation.tipo', 'Proceso'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($Transformations as $Transformation): ?>
            <tr>
                <td><?php echo $Transformation['Transformation']['id']; ?></td>
                <td><?php echo $Transformation['Transformation']['tipo']; ?></td>
                <td><?php echo $this->Ajax->link('editar', array('controller' => 'Transformations', 'action' => 'edit', $Transformation["Transformation"]["id"]), array('update' => 'transformaciones', 'indicator' => 'loading')); ?></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Transformations', 'action' => 'add', $productive_poll_id), array('update' => 'transformaciones', 'indicator' => 'loading')); ?>
