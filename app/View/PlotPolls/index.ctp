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
            <th><?php echo $this->Paginator->sort('PlotPoll.id', 'Id'); ?></th>
            <th><?php echo $this->Paginator->sort('PlotPoll.observaciones', 'Observaciones'); ?></th>
            <th>Responsable</th>
            <th>Fecha ultima visita</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($PlotPolls as $PlotPoll): ?>
            <tr>
                <td><?php echo $PlotPoll['PlotPoll']['id']; ?></td>
                <td><?php echo $PlotPoll['PlotPoll']['observaciones']; ?></td>
                <td><?php echo $PlotPoll['User']['nombre'] . " " . $PlotPoll['User']['primer_apellido']; ?></td>
                <td><?php echo $PlotPoll['PlotPoll']['fecha_ultima_visita']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'PlotPolls', 'action' => 'view_poll', $PlotPoll["PlotPoll"]["id"], $beneficiary_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'PlotPolls', 'action' => 'add', $beneficiary_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'), '¿Desea adicionar registro?'); ?>
