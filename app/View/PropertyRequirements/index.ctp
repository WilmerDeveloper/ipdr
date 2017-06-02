<table border="1" width="100%">
    <thead>
        <tr>
            <th align="center"><h1>REQUISITOS PREDIO <?php echo $predio['Property']['nombre'] ?></h1></th>
</tr>
</thead>
<tbody>

</tbody>
</table>
<table id="tabla" class="tabla"  >
    <thead>
        <tr>
            <th>ID </th>
            <th>TEXTO</th>
            <th>Concepto</th>
            <th>Calificación</th>
            <th colspan="3">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($requisitos as $rec): ?>
            <tr>
                <td><?php echo $rec['PropertyRequirement']['id'] ?></td>
                <td><?php echo $rec['InitialRequirement']['texto']; ?></td>
                <td><?php echo $rec['PropertyRequirement']['concepto'] ?></td>
                <td><?php echo $rec['PropertyRequirement']['calificacion'] ?></td>
                <td colspan="3"><?php if($cerrado==0) echo $this->Ajax->link("Ver concepto", array('controller' => 'PropertyRequirements', "action" => "edit", $rec['PropertyRequirement']['id']), array('update' => 'predios', 'complete' => 'formularioAjax()', 'indicator' => 'loading', 'class' => 'acciones')) ?></td>
                <td colspan="3"><?php if($cerrado==0)echo $this->Ajax->link("Eliminar", array('controller' => 'PropertyRequirements', "action" => "delete", $rec['PropertyRequirement']['id'],$rec['PropertyRequirement']['property_id']), array('update' => 'predios', 'complete' => 'formularioAjax()', 'indicator' => 'loading', 'class' => 'acciones'),'¿Desea eliminar el registro?') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>