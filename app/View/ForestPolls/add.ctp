<script>

    $(document).ready(function() {
         
   
        jQuery("#forest").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#forestal",
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
    <?php echo $this->Form->create("ForestPoll", array("id" => "forest", 'url' => array("action" => "add", $plot_id))); ?>
    <?php echo $this->Form->input('ForestPoll.productive_activity_id', array('label' => 'Actividad', 'class' => 'required')); ?>
    <?php echo $this->Form->input('ForestPoll.area', array('label' => 'Área', 'class' => 'required')); ?>
    <?php echo $this->Form->input('ForestPoll.observaciones', array('label' => 'Observaciones', 'class' => '')); ?>
    <?php echo $this->Form->hidden('ForestPoll.plot_poll_id', array('label' => 'plot_poll_id', 'value' => $plot_id)); ?>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>
</fieldset>