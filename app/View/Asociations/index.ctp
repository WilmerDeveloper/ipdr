

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
            <th><?php echo $this->Paginator->sort('Asociation.id', 'Id'); ?></th>
            <th><?php echo $this->Paginator->sort('Asociation.nombre', 'Nombre asociación'); ?></th>
            <th><?php echo $this->Paginator->sort('Asociation.observaciones', 'Observaciones'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Asociations as $Asociation): ?>
            <tr>
                <td><?php echo $Asociation['Asociation']['id']; ?></td>
                <td><?php echo $Asociation['Asociation']['nombre']; ?></td>
                <td><?php echo $Asociation['Asociation']['observaciones']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Asociations', 'action' => 'edit', $Asociation["Asociation"]["id"]), array('update' => 'content', 'indicator' => 'loading')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Asociations', 'action' => 'delete', $Asociation["Asociation"]["id"]), array('update' => 'content', 'indicator' => 'loading')); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php echo $this->Js->writeBuffer(); ?>

<?php
if (empty($Asociations))
    echo $this->Ajax->link('Adicionar', array('controller' => 'Asociations', 'action' => 'add', $beneficiary_id), array('update' => 'content', 'indicator' => 'loading'), '¿Desea agregar registro?');
?>
