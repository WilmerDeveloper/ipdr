<script>


    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#ambiente1"
                });
            }
        });  }
        
)
</script>

<div id="ambiente1">
    <fieldset>
        <?php echo $this->Form->create("Environment", array('id' => 'formulario', "action" => "edit/" . $property_id)); ?>
        <legend>Adición de Información edicional</legend>
        <?php echo $this->Form->hidden('Environment.id') ?>   
        <?php echo $this->Form->hidden('Environment.property_id') ?>   
        <legend>3.22 Zonas de inundación</legend>
        <?php echo $this->Form->input('Environment.inundacion_area', array('label' => 'Área de Inundación', 'class' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Environment.inundacion_periodo', array('label' => 'Periodo de Inundación', 'class' => '')); ?>
        <legend>3.23 Zonas con amenaza de derrumbes</legend>
        <?php echo $this->Form->input('Environment.derrumbe_area', array('label' => 'Área de la zona con amenaza de derrumbe', 'class' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Environment.derrumbe_ubicacion', array('label' => 'Ubicación de la zona con amenaza de derrumbe', 'class' => '')); ?>
        <?php echo $this->Form->input('Environment.sensibilizacion1', array('label' => '¿3.24 Los beneficiaderos de este predio han participado en jornadas de sensibilización y/o capacitación en temas de Buenas Prácticas Agrícolas y/o Ganaderas?', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
        <?php echo $this->Form->input('Environment.sensibilizacion2', array('label' => '3.25 ¿Los beneficiaderos de este predio han participado en jornadas de sensibilización y/o capacitación en temas del cuidado del medio ambiente?', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
        <?php echo $this->Form->input('Environment.observacion', array('label' => 'Observaciones', 'class' => '')); ?>
        <?php echo $this->Form->end("Guardar") ?>
    </fieldset>

</div>

