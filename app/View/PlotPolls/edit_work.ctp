<script>

    $(document).ready(function() {


        jQuery("#ob").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#obra",
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
    <?php echo $this->Form->create("PlotPoll", array("id" => "ob", "url" => array("action" => "edit_work", $this->data['PlotPoll']['id']))); ?>

    <?php echo $this->Form->hidden('PlotPoll.id'); ?>

    <?php echo $this->Form->input('PlotPoll.mano_obra_familiar', array('label' => 'Mano de obra familiar (Jornales)', 'class' => 'required')); ?>
    <?php echo $this->Form->input('PlotPoll.mano_obra_externa', array('label' => 'Mano de obra externa (Jornales)', 'class' => 'required')); ?>
    <?php echo $this->Form->input('PlotPoll.valor_jormal', array('label' => 'Valor jormal ($)', 'class' => 'required')); ?>

    <?php echo $this->Form->input('PlotPoll.observaciones', array('label' => 'observaciones', 'class' => '')); ?>
    <?php echo $this->Form->end(array("label" => "Guardar", "class" => "submit_button")) ?>
</fieldset>
