<script>


    $(document).ready(function() {


        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#livestocks",
                    beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });
    }

)

</script>
<div id="livestocks">
    <?php echo $this->Form->create("LiveStock", array("id" => "formulario", "action" => "edit/" . $this->data['LiveStock']['home_id'])); ?>
    <?php echo $this->Form->hidden('LiveStock.id'); ?>
    <?php echo $this->Form->input('LiveStock.tipo', array('label' => 'Tipo', 'class' => 'required', 'empty' => '', 'options' => array('Aves de corral' => 'Aves de corral', 'Conejos' => 'Conejos', 'Chivos' => 'Chivos', 'Cerdos' => 'Cerdos', 'Caballos' => 'Caballos', 'Burros' => 'Burros', 'Mulas' => 'Mulas', 'Ganado vacuno' => 'Ganado vacuno', 'Otro' => 'Otro'))); ?>
    <?php echo $this->Form->input('LiveStock.otro', array('label' => 'Otro ¿Cúal?', 'type' => 'numeric')); ?>
    <?php echo $this->Form->input('LiveStock.cantidad', array('label' => 'Cantidad', 'type' => 'numeric', 'class' => 'required')); ?>
    <?php echo $this->Form->hidden('LiveStock.home_id'); ?>
    <?php echo $this->Form->hidden('LiveStock.sincronizado', array('value' => 0)); ?>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>
</div>