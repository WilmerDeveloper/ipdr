<script>
    
    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#acti1"
                });
            }
        });  }
        
)
</script>
<div id="acti1">
    <fieldset>
        <?php echo $this->Form->create("Activity", array('id' => 'formulario', "action" => "edit/" . $property_id)); ?>
        <legend>Edición de Actividades</legend>
        <?php echo $this->Form->hidden('Activity.id') ?>   
        <?php echo $this->Form->hidden('Activity.property_id', array('type' => 'text')); ?>
        <?php echo $this->Form->input('Activity.actividad', array('label' => 'Actividades realizadas en el predio', 'empty' => '', 'class' => '', 'options' => array('Prácticas de riego' => 'Prácticas de riego', 'Sobrepastoreo' => 'Sobrepastoreo', 'Uso de agroquímicos' => 'Uso de agroquímicos', 'Labranza' => 'Labranza', 'Tala de árboles' => 'Tala de árboles', 'Quemas' => 'Quemas', 'Compactación de suelos' => 'Compactación de suelos', 'Pesca' => 'Pesca', 'Piscicultura' => 'Piscicultura'))); ?>
        <?php echo $this->Form->input('Activity.tipo_otro', array('label' => 'Otro, ¿Cuál?')); ?>
        <?php echo $this->Form->input('Activity.actividad_realizacion', array('label' => '¿Realiza este tipo de actividad?', 'empty' => '', 'class' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
        <?php echo $this->Form->input('Activity.frecuencia', array('label' => 'Frecuencia con la que realiza esta actividad', 'class' => '')); ?>
        <?php echo $this->Form->end("Guardar") ?>
    </fieldset>
</div>