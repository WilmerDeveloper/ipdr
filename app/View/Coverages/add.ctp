<script>
    
    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#cover"
                });
            }
        });  }
        
)
</script>
<div id="cover">
    <fieldset>
        <?php echo $this->Form->create("Coverage", array('id' => 'formulario', "action" => "add/" . $property_id)); ?>
        <legend>Adición de Coberturas</legend>
        <?php echo $this->Form->hidden('Property.id') ?>   
        <?php echo $this->Form->hidden('Coverage.property_id', array('value' => $property_id, 'type' => 'text')); ?>
        <?php echo $this->Form->input('Coverage.cobertura', array('label' => 'Tipo de Cobertura',  'empty' => '','class' => 'required', 'options' => array('Bosques' => 'Bosques', 'Montañas' => 'Montañas', 'Rastrojo' => 'Rastrojo', 'Pasto' => 'Pasto', 'Cultivos' => 'Cultivos', 'Otros' => 'Otros'))); ?>
        <?php echo $this->Form->input('Coverage.area', array('label' => 'Área', 'class' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Coverage.porcentaje', array('label' => 'Porcentaje', 'class' => '')); ?>
        <?php echo $this->Form->end("Guardar") ?>
    </fieldset>
</div>