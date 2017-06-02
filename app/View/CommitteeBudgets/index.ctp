<h1>Rubros del comite  de <?php echo $fecha_comite . " $codigo" ?></h1>
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
            <th><?php echo $this->Paginator->sort('MonitoringActivity.nombre', 'Rubro'); ?></th>
            <th><?php echo $this->Paginator->sort('CommitteeBudget.valor', 'Valor'); ?></th>
            <th><?php echo $this->Paginator->sort('CommitteeBudget.observacion', 'Observaciones'); ?></th>
            <th><?php echo $this->Paginator->sort('CommitteeBudget.adjunto', 'adjunto'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($CommitteeBudgets as $CommitteeBudget): ?>
            <tr>
                <td><?php echo $CommitteeBudget['MonitoringActivity']['nombre']; ?></td>
                <td><?php echo $CommitteeBudget['CommitteeBudget']['valor']; ?></td>
                <td><?php echo $CommitteeBudget['CommitteeBudget']['observacion']; ?></td>
                <td><?php echo $CommitteeBudget['CommitteeBudget']['adjunto']; ?></td>
                <td>

                    <?php echo $this->Ajax->link('Editar', array('controller' => 'CommitteeBudgets', 'action' => 'edit', $CommitteeBudget["CommitteeBudget"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?>
                    <?php echo $this->Ajax->link('Eliminar', array('controller' => 'CommitteeBudgets', 'action' => 'delete', $CommitteeBudget["CommitteeBudget"]["id"],$committee_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'),'¿Desea eliminar el registro?'); ?>
                    <?php
                    if (file_exists("../webroot/files/" . $proyect_id . "-" . $codigo . "/" . $CommitteeBudget['CommitteeBudget']['adjunto']) and $CommitteeBudget['CommitteeBudget']['adjunto'] != "") {
                        echo"<br>";
                        echo"<br>";
                        echo $this->Html->link('Ver_soporte ', "../files/" . $proyect_id . "-" . $codigo . "/" . $CommitteeBudget['CommitteeBudget']['adjunto'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>

<br>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>

        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Committees', 'action' => 'index', $follow_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>
<br>