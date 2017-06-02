<?php 
$totalCom1tmp=0;
$totalCom2tmp=0;
$totalCom3tmp=0;
$totalCom4tmp=0;
$tipo="";
$totalCom1=0;
$totalCom2=0;
$totalCom3=0;
$totalCom4=0;
$totalRubros=0;

?>
<table>
    <thead>
        <tr>
            
            <th></th>
            <th><?php echo ('Actividad'); ?></th>
            <th><?php echo ( 'Comité 1'); ?></th>
            <th><?php echo ( 'Comité 2'); ?></th>
            <th><?php echo ( 'Comité 3'); ?></th>
            <th><?php echo ( 'Comité 4'); ?></th>
            <th><?php echo ( 'Total valor rubros'); ?></th>
            <th></th>
           
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Budgets as $Budget): ?>
         
            <?php if($tipo!="" and $tipo!=$Budget['MonitoringActivity']['tipo']): ?>
        <tr>
            <td><b>Subtotal <?php echo($tipo) ?>:</b></td>
            <td></td>
            <td><b><?php echo number_format($totalCom1tmp,2,',','.' ) ; $totalCom1+= $totalCom1tmp?></b></td>
            <td><b><?php echo number_format($totalCom2tmp,2,',','.' ) ;  $totalCom2+= $totalCom2tmp?></b></td>
            <td><b><?php echo number_format($totalCom3tmp,2,',','.' ) ;  $totalCom3+= $totalCom3tmp?></b></td>
            <td><b><?php echo number_format($totalCom4tmp,2,',','.' ) ;  $totalCom4+= $totalCom4tmp?></b></td>
            <td><b><?php echo number_format($totalCom1tmp+$totalCom2tmp+$totalCom3tmp+$totalCom4tmp,2,',','.' ) ; $totalCom1tmp=0;$totalCom2tmp=0;$totalCom3tmp=0;$totalCom4tmp=0; ?></b></td>
            <td></td> 
            
        </tr>
            <?php endif;?>
            <tr>
                <td><?php echo $Budget['MonitoringActivity']['tipo']; ?></td>
                <td><?php echo $Budget['MonitoringActivity']['nombre']; ?></td>
                <td><?php echo number_format($Budget['Budget']['valor_comite1'],2,',','.' ) ; $totalCom1tmp+=$Budget['Budget']['valor_comite1']; ?></td>
                <td><?php echo number_format($Budget['Budget']['valor_comite2'],2,',','.' ) ; $totalCom2tmp+=$Budget['Budget']['valor_comite2']; ?></td>
                <td><?php echo number_format($Budget['Budget']['valor_comite3'],2,',','.' ) ; $totalCom3tmp+=$Budget['Budget']['valor_comite3']; ?></td>
                <td><?php echo number_format($Budget['Budget']['valor_comite4'],2,',','.' ) ; $totalCom4tmp+=$Budget['Budget']['valor_comite4']; ?></td>
                <td><b><?php echo $totLinea=$Budget['Budget']['valor_comite1']+$Budget['Budget']['valor_comite2']+$Budget['Budget']['valor_comite3']+$Budget['Budget']['valor_comite4'];$totalRubros+=$totLinea?></b></td> 
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Budgets', 'action' => 'edit_comite', $Budget["Budget"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'complete' => 'formularioAjax()')); ?></td>
            </tr>
           <?php $tipo=$Budget['MonitoringActivity']['tipo']; ?>
        <?php endforeach; ?>
              <?php if($tipo!=""): ?>
          <tr>
             <td><b>Subtotal <?php echo($tipo) ?>:</b></td>
            <td></td>
            <td><b><?php echo number_format($totalCom1tmp,2,',','.' ) ; $totalCom1+= $totalCom1tmp?></b></td>
            <td><b><?php echo number_format($totalCom2tmp,2,',','.' ) ;  $totalCom2+= $totalCom2tmp?></b></td>
            <td><b><?php echo number_format($totalCom3tmp,2,',','.' ) ;  $totalCom3+= $totalCom3tmp?></b></td>
            <td><b><?php echo number_format($totalCom4tmp,2,',','.' ) ;  $totalCom4+= $totalCom4tmp?></b></td>
            <td><b><?php echo number_format($totalCom1tmp+$totalCom2tmp+$totalCom3tmp+$totalCom4tmp,2,',','.' ) ; $totalCom1tmp=0;$totalCom2tmp=0;$totalCom3tmp=0;$totalCom4tmp=0; ?></b></td>
            <td></td> 
            
        </tr>
            <?php endif;?>
         <tr>
             <td><b>TOTAL:</b></td>
            <td></td>
            <td><b><?php echo number_format($totalCom1,2,',','.' ) ; ?></b></td>
            <td><b><?php echo number_format($totalCom2,2,',','.' ) ;  ?></b></td>
            <td><b><?php echo number_format($totalCom3,2,',','.' ) ;  ?></b></td>
            <td><b><?php echo number_format($totalCom4,2,',','.' ) ;  ?></b></td>
            <td><b><?php echo number_format($totalRubros,2,',','.' ) ; $totalCom1tmp=0;$totalCom2tmp=0;$totalCom3tmp=0;$totalCom4tmp=0; ?></b></td>
            <td></td> 
            
        </tr>
          
    </tbody>
</table>

<?php echo $this->Js->writeBuffer(); ?>
<br>
<?php echo $this->Html->link('Imprimir Plan de compras', array('controller' => 'Budgets', 'action' => 'print_plan', $follow_id), array( 'target' => '_blank', 'indicator' => 'loading', 'class'=>'acciones','class' => 'acciones' )); ?>

<br>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Follows', 'action' => 'index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>
<br>
