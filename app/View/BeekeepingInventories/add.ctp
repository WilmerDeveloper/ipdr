<script>

    $(document).ready(function() {


        jQuery("#formabejas").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#abejas",
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
    <?php echo $this->Form->create("BeekeepingInventory", array("id" => "formabejas", 'url' => array('controller' => 'BeekeepingInventories', "action" => "add", $productive_baseline_id))); ?>
    <?php echo $this->Form->input('BeekeepingInventory.botellas', array('label' => 'Botellas por año', 'class' => 'required')); ?>
    <?php echo $this->Form->hidden('BeekeepingInventory.productive_baseline_id', array('label' => 'productive_baseline_id', 'value' => $productive_baseline_id)); ?>
    <?php echo $this->Form->hidden('BeekeepingInventory.sincronizado', array('value' => 0)); ?>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>
</fieldset>
