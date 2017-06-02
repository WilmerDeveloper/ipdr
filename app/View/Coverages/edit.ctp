<script>


    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#cover1"
                });
            }
        });  }
        
)
</script>

<div id="cover1">
    <fieldset>
        <?php echo $this->Form->create("Coverage", array('id' => 'formulario', "action" => "edit/" . $this->data['Coverage']['id'])); ?>
        <?php echo $this->Form->hidden('Coverage.id') ?>   
        <?php echo $this->Form->hidden('Coverage.property_id', array('type' => 'text')); ?>
        <?php echo $this->Form->input('Coverage.cobertura', array('label' => 'Tipo de Cobertura', 'empty' => '','class' => 'required', 'options' => array('Bosques' => 'Bosques', 'Montañas' => 'Montañas', 'Rastrojo' => 'Rastrojo', 'Pasto' => 'Pasto', 'Cultivos' => 'Cultivos', 'Otros' => 'Otros'))); ?>
        <?php echo $this->Form->input('Coverage.area', array('label' => 'Área', 'class' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Coverage.porcentaje', array('label' => 'Porcentaje', 'class' => '')); ?>
        <?php echo $this->Form->end("Guardar") ?>
    </fieldset>

</div>

