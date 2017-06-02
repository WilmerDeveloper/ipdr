<script>

    $(document).ready(function() {
        $(".calendario").datepicker({
		
            showOn: 'both',
            buttonImage: './img/calendar.jpg',
            buttonImageOnly: true,
            changeYear: true,
            numberOfMonths: 1
                
        });

        jQuery("#cp").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#compromisos",
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
    <?php echo $this->Form->create("Liability", array("id" => "cp", "url" => array("action" => "add", $plot_poll_id))); ?>
    <?php echo $this->Form->input('Liability.compromiso', array('label' => 'Compromiso', 'class' => 'required')); ?>
    <?php echo $this->Form->input('Liability.mejora', array('label' => 'Acción de mejora', 'class' => 'required')); ?>
    <?php echo $this->Form->input('Liability.fecha_establecida', array('label' => 'Fecha establecida', 'class' => 'calendario', 'type' => 'required')); ?>
    <?php echo $this->Form->hidden('Liability.plot_poll_id', array('label' => 'plot_poll_id', 'value' => $plot_poll_id)); ?>
    <?php echo $this->Form->end(array("label" => "Guardar", "class" => "submit_button")) ?>
</fieldset>