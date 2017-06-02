<script>

    $(document).ready(function() {
        $(".calendario").datepicker({
		
            showOn: 'both',
            buttonImage: './img/calendar.jpg',
            buttonImageOnly: true,
            changeYear: true,
            numberOfMonths: 1
                
        });

        jQuery("#tp").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#tipologias",
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

    <?php echo $this->Form->create("Typology", array("id" => "tp", "url" => array("action" => "edit", $this->data['Typology']['id']))); ?>
    <?php echo $this->Form->hidden('Typology.id'); ?>
    <?php echo $this->Form->input('Typology.ambiental', array('label' => 'Ambiental', 'class' => '')); ?>
    <?php echo $this->Form->input('Typology.juridico', array('label' => 'Jurico', 'class' => '')); ?>
    <?php echo $this->Form->input('Typology.social', array('label' => 'Social', 'class' => '')); ?>
    <?php echo $this->Form->input('Typology.observaciones', array('label' => 'Descripción', 'class' => 'required')); ?>
    <?php echo $this->Form->hidden('Typology.plot_poll_id', array('label' => 'plot_poll_id', 'class' => '')); ?>
    <?php echo $this->Form->end(array("label" => "Guardar", "class" => "submit_button")) ?>
</fieldset>