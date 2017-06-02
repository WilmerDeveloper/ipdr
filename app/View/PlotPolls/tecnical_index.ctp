<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#asistencia', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table>
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('PlotPoll.asistencia_tecnica', '¿Recibe asistencia técnica?'); ?></th>
            <th><?php echo $this->Paginator->sort('PlotPoll.entidad_asistencia', 'Entidad'); ?></th>
            <th><?php echo $this->Paginator->sort('PlotPoll.frecuencia_visita_tecnica', 'Visitas por año'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($PlotPolls as $PlotPoll): ?>
            <tr>
                <td><?php echo $PlotPoll['PlotPoll']['asistencia_tecnica']; ?></td>
                <td><?php echo $PlotPoll['PlotPoll']['entidad_asistencia']; ?></td>
                <td><?php echo $PlotPoll['PlotPoll']['frecuencia_visita_tecnica']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'PlotPolls', 'action' => 'tecnical_edit', $PlotPoll["PlotPoll"]["id"]), array('update' => 'asistencia', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
