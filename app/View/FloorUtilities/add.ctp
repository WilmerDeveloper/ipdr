<script>
    
    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#actual"
                });
            }
        });  }
        
)

</script>
<div id="actual">
    <?php echo $this->Form->create("FloorUtility", array("id" => "formulario", "action" => "add/" . $property_id)); ?>
    <fieldset><legend>Adición de Usos actuales de Suelo</legend>
        <?php echo $this->Form->hidden('FloorUtility.property_id', array( 'value' => $property_id, 'type' => 'text')); ?>
        <?php echo $this->Form->input('FloorUtility.clase', array('label' => 'Clase Agrológica', 'class' => 'required', 'empty' => '', 'options' => array('I' => 'I', 'II' => 'II', 'III' => 'III', 'IV' => 'IV', 'V' => 'V', 'VI' => 'VI', 'VII' => 'VII', 'VIII' => 'VIII'))); ?>
        <?php echo $this->Form->input('FloorUtility.agricultura', array('label' => 'Agricultura (%)', 'class' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('FloorUtility.pecuaria', array('label' => 'Pecuaria (%)', 'class' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('FloorUtility.forestal_productiva', array('label' => 'Forestal Productiva (%)', 'class' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('FloorUtility.otros_usos', array('label' => 'Otros Usos (%)', 'class' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('FloorUtility.area_no_explotada', array('label' => 'Area no explotada (%)', 'class' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('FloorUtility.forestal_protectora', array('label' => 'Forestal Protectora (%)', 'class' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('FloorUtility.no_productiva', array('label' => 'No Productiva (%)', 'class' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->end("Guardar") ?>
    </fieldset>
</div>