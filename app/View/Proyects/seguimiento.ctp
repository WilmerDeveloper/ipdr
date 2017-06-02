<br/>
<br/>
<?php

echo $this->Html->link('Listado Beneficiarios', array('controller' => 'PlotPolls', 'action' => 'print_list'), array('target' => '_blank', 'class' => 'acciones', 'indicator' => 'loading')) ?>
<br/>
<br/>
<table id="tabla">
    <tbody>
        <tr>
            <td><?php echo $this->Ajax->link('Lineas_productivas', array('controller' => 'FollowProducts', 'action' => 'index', $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?><br><br></td>
            <td><?php echo $this->Ajax->link('Extractos', array('controller' => 'Extracts', 'action' => 'index', $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?><br><br></td>
            <td><?php echo $this->Ajax->link('Plan_inversión', array('controller' => 'Follows', 'action' => 'index', $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?><br><br></td>
        </tr>
        <tr>
            <td><?php echo $this->Ajax->link('Comités_de_compras', array('controller' => 'Committees', 'action' => 'index', $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?><br><br></td>
            <td><?php echo $this->Ajax->link('Visitas_seguimiento', array('controller' => 'Visits', 'action' => 'index', $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?><br><br></td>
            <td><?php echo $this->Ajax->link('Acompañamiento', array('controller' => 'Advices', 'action' => 'index', $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?><br><br></td>
        </tr>
        <tr>
            <td><?php echo $this->Ajax->link('Reporte final', array('controller' => 'FinalReports', 'action' => 'index', $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?><br><br></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
<br/>
<br/>
