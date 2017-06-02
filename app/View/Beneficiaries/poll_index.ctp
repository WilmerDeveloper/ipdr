
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
                <td ><?php echo $this->Ajax->submit('Buscar', array('url' => array('controller' => 'Beneficiaries', 'action' => 'poll_index'), 'update' => 'content', 'indicator' => 'loading')); ?></td>
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
                <?php echo $this->Ajax->link("Control operativo", array('controller' => 'FamilyPolls', "action" => "index", $ben['Beneficiary']['id']), array('update' => 'content', 'complete' => 'formularioAjax()', 'indicator' => 'loading', 'class' => 'acciones')) ?>
                <br>      
                <br>      
                <?php echo $this->Ajax->link("Información_del_beneficiario", array('controller' => 'Beneficiaries', "action" => "edit_poll", $ben['Beneficiary']['id']), array('update' => 'content', 'complete' => 'formularioAjax()', 'indicator' => 'loading', 'class' => 'acciones')) ?>
                <br>      
                <br>      
                <?php echo $this->Ajax->link("Familiares", array('controller' => 'Families', "action" => "poll_index", $ben['Beneficiary']['id']), array('update' => 'content', 'complete' => 'formularioAjax()', 'indicator' => 'loading', 'class' => 'acciones')) ?>
                <br>      
                <br>      
                <?php echo $this->Ajax->link("Condiciones_de_vida", array('controller' => 'Homes', "action" => "index", $ben['Beneficiary']['id']), array('update' => 'content', 'complete' => 'formularioAjax()', 'indicator' => 'loading', 'class' => 'acciones')) ?>
                <br>      
                <br>      
                <?php echo $this->Ajax->link("Producción_y_comercialización", array('controller' => 'ProductivePolls', "action" => "index", $ben['Beneficiary']['id']), array('update' => 'content', 'complete' => 'formularioAjax()', 'indicator' => 'loading', 'class' => 'acciones')) ?>
                <br>      
                <br>      
                <?php echo $this->Ajax->link("Asociación_y_organización", array('controller' => 'Asociations', "action" => "index", $ben['Beneficiary']['id']), array('update' => 'content', 'complete' => 'formularioAjax()', 'indicator' => 'loading', 'class' => 'acciones')) ?>

            </td>

        </tr>
    <?php endforeach; ?>
</tbody>
</table>
<br>
<br>






