<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#ocupantes', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table>
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('Occupant.nombres', 'Nombres'); ?></th>
            <th><?php echo $this->Paginator->sort('Occupant.apellidos', 'Apellidos'); ?></th>
            <th><?php echo $this->Paginator->sort('Occupant.tipo_documento', 'Tipo documento'); ?></th>
            <th><?php echo $this->Paginator->sort('Occupant.documento', 'Documento'); ?></th>
            <th><?php echo $this->Paginator->sort('Occupant.parentesco', 'Parentesco'); ?></th>
            <th><?php echo $this->Paginator->sort('Occupant.tipo_ocupacion', 'Tipo de ocupación'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Occupants as $Occupant): ?>
            <tr>
                <td><?php echo $Occupant['Occupant']['nombres']; ?></td>
                <td><?php echo $Occupant['Occupant']['apellidos']; ?></td>
                <td><?php echo $Occupant['Occupant']['tipo_documento']; ?></td>
                <td><?php echo $Occupant['Occupant']['documento']; ?></td>
                <td><?php echo $Occupant['Occupant']['parentesco']; ?></td>
                <td><?php echo $Occupant['Occupant']['tipo_ocupacion']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Occupants', 'action' => 'edit', $Occupant["Occupant"]["id"]), array('update' => 'ocupantes', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Occupants', 'action' => 'delete', $Occupant["Occupant"]["id"], $plot_poll_id), array('update' => 'ocupantes', 'indicator' => 'loading', 'class' => 'acciones'), '¿Desea eliminar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Occupants', 'action' => 'add', $plot_poll_id), array('update' => 'ocupantes', 'indicator' => 'loading', 'class' => 'acciones')); ?>
