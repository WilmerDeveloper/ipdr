<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#general', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table>
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('PlotPoll.area_ha', 'Área (Parte hectáreas)'); ?></th>
            <th><?php echo $this->Paginator->sort('PlotPoll.area_m', 'Área (Parte metros)'); ?></th>
            <th><?php echo $this->Paginator->sort('PlotPoll.cuenta_con_vivienda', '¿La familia cuenta con vivienda en el predio'); ?></th>
            <th><?php echo $this->Paginator->sort('PlotPoll.comparte_vivienda', '¿La comparte con otros beneficiarios?'); ?></th>
            <th><?php echo $this->Paginator->sort('PlotPoll.Habita_vivienda', '¿Quien habita la vivienda?'); ?></th>
            <th><?php echo $this->Paginator->sort('PlotPoll.numero_de_parcela', 'Parcela número'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($PlotPolls as $PlotPoll): ?>
            <tr>
                <td><?php echo $PlotPoll['PlotPoll']['area_ha']; ?></td>
                <td><?php echo $PlotPoll['PlotPoll']['area_m']; ?></td>
                <td><?php echo $PlotPoll['PlotPoll']['cuenta_con_vivienda']; ?></td>
                <td><?php echo $PlotPoll['PlotPoll']['comparte_vivienda']; ?></td>
                <td><?php echo $PlotPoll['PlotPoll']['Habita_vivienda']; ?></td>
                <td><?php echo $PlotPoll['PlotPoll']['numero_de_parcela']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'PlotPolls', 'action' => 'edit_general', $PlotPoll["PlotPoll"]["id"]), array('update' => 'general', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
