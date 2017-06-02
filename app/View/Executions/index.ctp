
<table>
    <thead>
        <tr>
            <th>Rubro</th>
            <th>Fecha</th>
            <th>Acumulado hasta la fecha</th>
            <th>Ejecutado a la fecha</th>
            <th></th>
            
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Executions as $Execution): ?>
            <tr>
                
                <td><?php echo $Execution['MonitoringActivity']['nombre']; ?></td>
                <td><?php echo $Execution['Execution']['modificado']; ?></td>
                <td><?php echo str_replace(".0000", "",$Execution['Execution']['acumulado']); ?></td>
                <td><?php echo str_replace(".0000", "",$Execution['Execution']['ejecutado'] ); ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Executions', 'action' => 'edit',$Execution['Execution']['id'],$follow_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<br>
<table style="width: 400px" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>  
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'visits', 'action' => 'index',$follow_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>
<br>