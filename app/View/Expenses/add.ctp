<script>

    $(document).ready(function() {
        jQuery("#ideF").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#gastos",
                    beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });
    }

    )
</script>
<div>
    <?php echo $this->Form->create("Expense", array("id" => "ideF", 'url' => array('controller' => 'expenses', "action" => "add", $family_poll_id))); ?>

    <div style="border: solid 1px;border-color: #0063DC"><b>Ingresos propios:</b>
        <fieldset>
            <?php echo $this->Form->input('Expense.ingreso_agricola', array('label' => 'Agrícola', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.ingreso_pecuario', array('label' => ' Pecuarios', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.ingreso_otras_actividades', array('label' => 'Otras actividades', 'class' => '')); ?>
        </fieldset>
    </div>
    <div style="border: solid 1px;border-color: #0063DC"><b>Otros ingresos:</b>
        <fieldset>
            <?php echo $this->Form->input('Expense.mano_obra_alquilada', array('label' => 'Mano de obra alquilada', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.subsidios', array('label' => 'Subsidios', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.remesas', array('label' => 'Remesas familiares', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.otros_ingresos', array('label' => 'Otros ingresos', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.provienen', array('label' => 'De donde provienen los Ingresos', 'class' => '')); ?>
        </fieldset>
    </div>
    <div style="border: solid 1px;border-color: #0063DC"><b>Gastos mensuales del hogar:</b>
        <fieldset>
            <?php echo $this->Form->input('Expense.gasto_alimentacion', array('label' => 'Alimentación', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.gasto_servicios', array('label' => 'Servicios', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.gasto_educacion', array('label' => 'Educación', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.gasto_transporte', array('label' => 'Transporte', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.gasto_salud', array('label' => 'Salud', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.gasto_arriendo', array('label' => 'Arriendo', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.gasto_entretenimiento', array('label' => 'Entretenimiento', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.gasto_comunicaciones', array('label' => 'Comunicaciones', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.gasto_deudas', array('label' => 'Pago deudas', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.gasto_otro', array('label' => 'otro', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.nombre_gasto_otros', array('label' => '¿Cuál?', 'class' => '')); ?>
        </fieldset>
    </div>
    <div style="border: solid 1px;border-color: #0063DC">
        <fieldset><b>De acuerdo con las siguientes actividades económicas  identifique las tres que generan más ingresos para usted y su familia.   (Ordene de 1 a 3,  siendo 1 el más importante)</b>

            <?php echo $this->Form->input('Expense.agricultura', array('label' => 'Agricultura', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.pesca', array('label' => 'Pesca', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.ganaderia', array('label' => 'Ganaderia', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.comercio', array('label' => 'Comercio', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.transporte', array('label' => 'Transporte', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.mano_obra', array('label' => 'Mano de obra fuera de la comunidad', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.artesanias', array('label' => 'Artesanias', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.bares', array('label' => 'Bares y restaurantes', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.servicio_domestico', array('label' => 'Servicio domestico', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.jornalero', array('label' => 'Jornalero', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.otra_actividad', array('label' => 'Otra', 'class' => '')); ?>
        </fieldset>
    </div>
    <div style= "border: solid 1px; border-color: #0063DC">¿Sus ingresos son suficientes para cubrir sus necesidades básicas? (Alimentación, Educación, Vivienda, Salud)
        <fieldset>
            <?php echo $this->Form->input('Expense.ingresos_suficientes', array('label' => ' ', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
        </fieldset>
    </div>
    <div style= "border: solid 1px; border-color: #0063DC"><b>¿Usted o algún miembro de su familia ha recibido amenazas o ha sido objeto de algún hecho violento en el último año??</b>
        <fieldset>
            <?php echo $this->Form->input('Expense.amenazas', array('label' => '¿Usted o algún miembro de su familia ha recibido amenazas o ha sido objeto de algún hecho violento en el último año?', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
        </fieldset>
    </div>
    <div style= "border: solid 1px; border-color: #0063DC"><b>¿Cuáles han sido las consecuencias de estos hechos violentos?</b>
        <fieldset>
            <?php echo $this->Form->input('Expense.desplazamiento', array('label' => 'Desplazamiento', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.perdida_familiares', array('label' => 'Perdida familiares', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.perdida_propiedad', array('label' => 'Perdida propiedad', 'class' => '')); ?>
        </fieldset>
    </div>
    <div style= "border: solid 1px; border-color: #0063DC"><b>¿Ha tenido condición de vulnerabilidad?</b>
        <fieldset>
            <?php echo $this->Form->input('Expense.vulnerabilidad', array('label' => '          ', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
            <?php echo $this->Form->input('Expense.vulnerabilidad_desplazamiento', array('label' => 'Desplazamiento', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.vulnerabilidad_clima', array('label' => 'Clima', 'class' => '')); ?>
            <?php echo $this->Form->input('Expense.vulnerabilidad_orden_publico', array('label' => 'Orden_publico', 'class' => '')); ?>
            <?php echo $this->Form->hidden('Expense.family_poll_id', array('label' => 'family_poll_id', 'value' => $family_poll_id)); ?>
        </fieldset>
    </div>
    <?php echo $this->Form->hidden('Expense.sincronizado', array('value' => 0, 'type' => 'text')); ?>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>

</div>
