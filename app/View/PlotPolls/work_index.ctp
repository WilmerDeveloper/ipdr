<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#obra', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table>
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('PlotPoll.mano_obra_familiar', 'Mano de obra familiar'); ?></th>
            <th><?php echo $this->Paginator->sort('PlotPoll.mano_obra_externa', 'Mano de obra externa'); ?></th>
            <th><?php echo $this->Paginator->sort('PlotPoll.valor_jormal', 'Valor jornal'); ?></th>
            <th><?php echo $this->Paginator->sort('', 'Total'); ?></th>
            <th><?php echo $this->Paginator->sort('PlotPoll.observaciones', 'Observaciones'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($PlotPolls as $PlotPoll): ?>
            <tr>
                <td><?php echo $PlotPoll['PlotPoll']['mano_obra_familiar']; ?></td>
                <td><?php echo $PlotPoll['PlotPoll']['mano_obra_externa']; ?></td>
                <td><?php echo "$" . number_format($PlotPoll['PlotPoll']['valor_jormal'], 0, ',', '.'); ?></td>
                <td><?php echo "$" . number_format(($PlotPoll['PlotPoll']['valor_jormal'] * $PlotPoll['PlotPoll']['mano_obra_externa'] + ( $PlotPoll['PlotPoll']['valor_jormal'] * $PlotPoll['PlotPoll']['mano_obra_familiar'] )), 0, ',', '.') ?></td>
                <td><?php echo $PlotPoll['PlotPoll']['observaciones']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'PlotPolls', 'action' => 'edit_work', $PlotPoll["PlotPoll"]["id"]), array('update' => 'obra', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
