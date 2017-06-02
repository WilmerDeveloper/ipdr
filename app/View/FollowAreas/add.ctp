<script>

    $(document).ready(function() {
         
   
        jQuery("#act").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#areas",
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
    <?php echo $this->Form->create("FollowArea", array("id" => "act", 'url' => array("action" => "add", $plot_id))); ?>
    <?php echo $this->Form->input('FollowArea.productive_activity_id', array('label' => 'Actividad', 'class' => 'required')); ?>
    <?php echo $this->Form->input('FollowArea.area', array('label' => 'Área', 'class' => 'required')); ?>
    <?php echo $this->Form->input('FollowArea.observaciones', array('label' => 'Observaciones', 'class' => '')); ?>
    <?php echo $this->Form->hidden('FollowArea.plot_poll_id', array('label' => 'plot_poll_id', 'value' => $plot_id)); ?>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>
</fieldset>