<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'visits', 'action' => 'index', $follow_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>
<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#content', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table id="tabla">
    <thead>
        <tr>
            <th>Id</th>
            <th>Observaciones</th>
            <th>Primer apellido</th>
            <th>Primer nombre</th>
            <th>Fecha ultima visita</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($PlotPolls as $PlotPoll): ?>
            <tr>
                <td><?php echo $PlotPoll['PlotPoll']['id']; ?></td>
                <td><?php echo $PlotPoll['PlotPoll']['observaciones'] ?></td>
                <td><?php echo $PlotPoll['Candidate']['1er_apellido'] ?></td>
                <td><?php echo $PlotPoll['Candidate']['1er_nombre'] ?></td>
                <td><?php echo $PlotPoll['PlotPoll']['fecha_ultima_visita']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'PlotPolls', 'action' => 'view_poll', $PlotPoll["PlotPoll"]["id"], $PlotPoll["Candidate"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'actions')); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'visits', 'action' => 'index', $follow_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>