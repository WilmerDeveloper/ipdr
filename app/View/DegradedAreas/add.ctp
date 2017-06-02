<script>
    
    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#degradadas"
                });
            }
        });  }
        
)
</script>
<div id="degradadas">
    <fieldset>
        <?php echo $this->Form->create("DegradedArea", array('id' => 'formulario', "action" => "add/" . $property_id)); ?>
        <legend>Adición de Coberturas</legend>
        <?php echo $this->Form->hidden('Property.id') ?>   
        <?php echo $this->Form->hidden('DegradedArea.property_id', array('value' => $property_id, 'type' => 'text')); ?>
        <?php echo $this->Form->input('DegradedArea.causa', array('label' => 'Tipo de Causa',  'empty' => '','class' => 'required', 'options' => array('Erosión' => 'Erosión', 'Deforestación' => 'Deforestación', 'Explotación minera' => 'Explotación minera', 'Uso de agroquímicos' => 'Uso de agroquímicos', 'Sobrepastoreo' => 'Sobrepastoreo', 'Otros' => 'Otros'))); ?>
        <?php echo $this->Form->input('DegradedArea.area', array('label' => 'Área', 'class' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('DegradedArea.porcentaje', array('label' => 'Porcentaje', 'class' => '')); ?>
        <?php echo $this->Form->end("Guardar") ?>
    </fieldset>
</div>