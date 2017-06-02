
<table  id="tabla" class="index" >
    <thead>
        <tr>


            <th></th>
            <th>Predio</th>
            <th>Documento Identidad</th>
            <th>Primer nombre</th>
            <th>Primer Apellido</th>
            <th colspan="2">

    <form style="clear: both" >
        <table border="0" cellspacing="0" cellpaddding="0" style="width: 200px;height: 20px; padding: 0px 0px 0px 0px">
            <tr>
                <td ><input type="text"  name="data[Beneficiary][busqueda]" style="width: 130px" ></td>
                <td ><?php echo $this->Ajax->submit('Buscar', array('url' => array('controller' => 'Beneficiaries', 'action' => 'baseline_index',$property_id), 'update' => 'content', 'indicator' => 'loading')); ?></td>
            </tr>
        </table>
    </form>
           </th>
</tr>
</thead>
<tbody>

    <?php
    $cont = 0;
    foreach ($beneficiarios as $ben):
        ?>
        <?php
        $cont++;
        ?>
        <tr style="background-color: <?php ?>">
            <td><?php echo $cont ?></td>
            <td><?php echo $ben['Property']['nombre'] ?></td>
            <td><?php echo $ben['Beneficiary']['numero_identificacion'] ?></td>
            <td><?php echo $ben['Beneficiary']['nombres'] ?></td>
            <td><?php echo $ben['Beneficiary']['primer_apellido'] ?></td>

            <td>
                <?php echo $this->Ajax->link("Linea base", array('controller' => 'FamilyPolls', "action" => "baseline_index", $ben['Beneficiary']['id']), array('update' => 'content', 'complete' => 'formularioAjax()', 'indicator' => 'loading', 'class' => 'acciones')) ?>
             
            </td>

        </tr>
    <?php endforeach; ?>
</tbody>
</table>
<br>
<br>


<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Properties', 'action' => 'baselines_index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>



