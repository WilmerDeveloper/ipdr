<script>
    
    $(document).ready(function() {
        
        
        jQuery("#formularioAvicola").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#avicola",
                    beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });  }
        
)
</script>
<?php echo $this->Form->create("PoultryInventory", array("id" => "formularioAvicola", 'url'=>array('controller'=>'PoultryInventories',  "action" => "add",$productive_baseline_id) )); ?>
<table border="1">
    <thead>
        <tr>
            <th colspan="2">Inventario de aves de corral y traspatio</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Tipo de ave</td>
            <td>Cantidad</td>
        </tr>
        <tr>
            <td>Pollos de engorde:</td>
            <td><?php echo $this->Form->input('PoultryInventory.pollos_engorde', array('label' => '', 'class' => '')); ?></td>
        </tr>
        <tr>
            <td>Gallinas de postura</td>
            <td><?php echo $this->Form->input('PoultryInventory.gallinas_de_postura', array('label' => '', 'class' => '')); ?></td>
        </tr>
        <tr>
            <td>Aves de traspatio (Pollos, Gallos,  Gallinas)</td>
            <td><?php echo $this->Form->input('PoultryInventory.aves_de_traspatio', array('label' => '', 'class' => '')); ?></td>
        </tr>
        <tr>
            <td>Patos</td>
            <td><?php echo $this->Form->input('PoultryInventory.patos', array('label' => '', 'class' => '')); ?></td>
        </tr>
        <tr>
            <td>Piscos (Pavos, Bimbos)</td>
            <td><?php echo $this->Form->input('PoultryInventory.piscos', array('label' => '', 'class' => '')); ?></td>
        </tr>
        <tr>
            <td>Codornices</td>
            <td><?php echo $this->Form->input('PoultryInventory.codornices', array('label' => '', 'class' => '')); ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
<table border="1">
    <thead>
        <tr>
            <th colspan="3">Producción de huevos</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Items</td>
            <td>Gallinas de postura</td>
            <td>Gallinas de traspatio</td>
        </tr>
        <tr>
            <td>¿Hubo producción de huevos la semana anterior a la de la visita?</td>
            <td><?php echo $this->Form->input('PoultryInventory.producion_postura', array('label' => '', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?></td>
            <td><?php echo $this->Form->input('PoultryInventory.producion_traspatio', array('label' => '', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?></td>
        </tr>
        <tr>
            <td>¿Cuántos huevos se produjeron la semana anterior?</td>
            <td><?php echo $this->Form->input('PoultryInventory.huevos_galinas_postura', array('label' => '', 'class' => '')); ?></td>
            <td><?php echo $this->Form->input('PoultryInventory.huevos_galinas_traspatio', array('label' => '', 'class' => '')); ?></td>
        </tr>
        <tr>
            <td>¿Cuántos de estos huevos se destinaron para autoconsumo?</td>
            <td><?php echo $this->Form->input('PoultryInventory.autoconsumo_postura', array('label' => '', 'class' => '')); ?></td>
            <td><?php echo $this->Form->input('PoultryInventory.autoconsumo_traspatio', array('label' => '', 'class' => '')); ?></td>
        </tr>
        <tr>
            <td>¿Cuántos de estos huevos se destinaron para la venta?</td>
            <td><?php echo $this->Form->input('PoultryInventory.venta_postura', array('label' => '', 'class' => '')); ?></td>
            <td><?php echo $this->Form->input('PoultryInventory.venta_traspatio', array('label' => '', 'class' => '')); ?></td>
        </tr>

    </tbody>
</table>
<table border="1">
    <thead>
        <tr>
            <th colspan="2">Instalaciones (Registre el área en m2según corresponda)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Galpón</td>
            <td>
                Corral
            </td>
        </tr>
        <tr>
            <td><?php echo $this->Form->input('PoultryInventory.area_galpon', array('label' => '', 'class' => '')); ?></td>
            <td><?php echo $this->Form->input('PoultryInventory.area_corral', array('label' => '', 'class' => '')); ?></td>
        </tr>
    </tbody>
</table>
<table border="1">
    <thead>
        <tr>
            <th>Material del piso</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <?php echo $this->Form->input('PoultryInventory.piso_cemento', array('label' => 'Cemento', 'class' => '')); ?>
                <br>               
                <?php echo $this->Form->input('PoultryInventory.piso_madera', array('label' => 'Madera', 'class' => '')); ?>
                <br>           
                <?php echo $this->Form->input('PoultryInventory.piso_tierra', array('label' => 'Tierra', 'class' => '')); ?>
                <br>     
                <?php echo $this->Form->input('PoultryInventory.piso_otro', array('label' => 'Otro', 'class' => '')); ?>

            </td>
        </tr>
    </tbody>
</table>
<table border="1">
    <thead>
        <tr>
            <th colspan="2">Aspectos sanitarios</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                ¿Realizó desinfección de las instalaciones antes del ingreso de las aves?
            </td>
            <td>
                <?php echo $this->Form->input('PoultryInventory.desinfeccion', array('label' => '', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
            </td>

        </tr>
        <tr>
            <td>
                Durante el año 2012 vacunó contra:
            </td>
            <td>
                <?php echo $this->Form->input('PoultryInventory.vacuna_newcastle', array('label' => 'Newcastle', 'class' => '')); ?>
                <?php echo $this->Form->input('PoultryInventory.vacuna_gumboro', array('label' => 'Gumboro', 'class' => '')); ?>
                <?php echo $this->Form->input('PoultryInventory.vacuna_salomonella', array('label' => 'Salomonella', 'class' => '')); ?>
                <?php echo $this->Form->input('PoultryInventory.vacuna_bronquitis', array('label' => 'Bronquitis', 'class' => '')); ?>
                <?php echo $this->Form->hidden('PoultryInventory.productive_baseline_id', array('label' => 'properties_id', 'value' => $productive_baseline_id)); ?>

            </td>



        </tr>
    </tbody>
</table>


<?php echo $this->Form->hidden('PoultryInventory.sincronizado', array('value' => 0)); ?>
<?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>

