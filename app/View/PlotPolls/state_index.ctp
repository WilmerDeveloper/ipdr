<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#estado', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table border="1">
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('PlotPoll.fecha_ultima_visita', 'Fecha última visita de seguimiento'); ?></th>
            <th><?php echo $this->Paginator->sort('PlotPoll.tipologia_social', 'Tipológia social'); ?></th>
            <th><?php echo $this->Paginator->sort('PlotPoll.tipologia_ambiental', 'Tipológia ambiental'); ?></th>
            <th><?php echo $this->Paginator->sort('PlotPoll.tipologia_juridica', 'Tipológia júridica'); ?></th>
            <th><?php echo $this->Paginator->sort('PlotPoll.otra_tipologia', 'Otra tipológia'); ?></th>


            <th><?php echo $this->Paginator->sort('PlotPoll.acciones_de_mejora', 'Acciones de mejora'); ?></th>
            <th><?php echo $this->Paginator->sort('PlotPoll.resultado', 'Resultado Acciones de mejora'); ?></th>
            
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($PlotPolls as $PlotPoll): ?>
            <tr>
                <td><?php echo $PlotPoll['PlotPoll']['fecha_ultima_visita']; ?></td>
                <td><?php echo $PlotPoll['PlotPoll']['tipologia_social']; ?></td>
                <td><?php echo $PlotPoll['PlotPoll']['tipologia_ambiental']; ?></td>
                <td><?php echo $PlotPoll['PlotPoll']['tipologia_juridica']; ?></td>
                <td><?php echo $PlotPoll['PlotPoll']['otra_tipologia']; ?></td>
                <td><?php echo $PlotPoll['PlotPoll']['acciones_de_mejora']; ?></td>
                <td><?php echo $PlotPoll['PlotPoll']['resultado']; ?></td>
                
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'PlotPolls', 'action' => 'edit_state', $PlotPoll["PlotPoll"]["id"]), array('update' => 'estado', 'indicator' => 'loading')); ?></td>
            </tr>
            <tr>
                <td colspan="6"><b>¿Se observa alguna causal de incumplimiento con las condiciones de régimen parcelario? </b> </td>
                <td><b><?php echo $PlotPoll['PlotPoll']['incumplimiento']; ?></b></td>
                
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
