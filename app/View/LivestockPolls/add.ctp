
<script>

    $(document).ready(function() {
         
   
        jQuery("#pec").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#pecuario",
                    beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });
    }

)
</script>
<fieldset>
    <?php echo $this->Form->create("LivestockPoll", array("id" => "pec", 'url' => array("action" => "add", $plot_poll_id))); ?>
    <?php echo $this->Form->input('LivestockPoll.productive_activity_id', array('label' => 'Actividad', 'class' => 'required')); ?>
    <?php echo $this->Form->input('LivestockPoll.cantidad', array('label' => 'Cantidad', 'class' => 'required')); ?>
    <?php echo $this->Form->input('LivestockPoll.raza', array('label' => 'Raza', 'class' => 'required')); ?>
    <?php echo $this->Form->input('LivestockPoll.observaciones', array('label' => 'Observaciones', 'class' => '')); ?>
    <?php echo $this->Form->hidden('LivestockPoll.plot_poll_id', array('value' => $plot_poll_id)); ?>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>
</fieldset>