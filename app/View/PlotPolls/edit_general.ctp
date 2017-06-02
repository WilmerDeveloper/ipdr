<script>

    $(document).ready(function() {
        
        $(".calendario").datepicker({
		
            showOn: 'both',
            buttonImage: './img/calendar.jpg',
            buttonImageOnly: true,
            changeYear: true,
            numberOfMonths: 1
                
        });
        
        jQuery("#gn").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#general",
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
    <?php echo $this->Form->create("PlotPoll", array("id" => "gn", "url" => array("action" => "edit_general", $this->data['PlotPoll']['id']))); ?>
    <?php echo $this->Form->hidden('PlotPoll.id'); ?>

    <?php echo $this->Form->input('PlotPoll.fecha_ultima_visita', array('label' => 'Fecha ultima visita', 'type' => 'text', 'class' => 'calendario')); ?>
    <?php echo $this->Form->input('PlotPoll.observaciones', array('label' => 'Observaciones')); ?>

    <?php echo $this->Form->input('PlotPoll.numero_de_parcela', array('label' => 'Parcela Número: ')); ?>
    <?php echo $this->Form->input('PlotPoll.area_ha', array('label' => 'Área (Parte hectareas)', 'class' => 'required')); ?>
    <?php echo $this->Form->input('PlotPoll.area_m', array('label' => 'Área (Parte metros)', 'class' => 'required')); ?>

    <?php echo $this->Form->input('PlotPoll.cuenta_con_vivienda', array('label' => '¿La familia cuenta con vivienda en el predio', 'class' => 'required', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
    <?php echo $this->Form->input('PlotPoll.comparte_vivienda', array('label' => '¿La comparte con otros beneficiarios?  ', 'class' => 'required', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
    <?php echo $this->Form->input('PlotPoll.Habita_vivienda', array('label' => '¿Quien habita la vivienda?', 'class' => 'required', 'empty' => '', 'options' => array('Adjudicatario' => 'Adjudicatario', 'Otro' => 'Otro', 'No habitada' => 'No habitada'))); ?>
    <?php echo $this->Form->input('PlotPoll.incumplimiento', array('label' => '¿Se observa alguna causal de incumplimiento con las condiciones de régimen parcelario?', 'empty' => '', 'options' => array('1' => 'Si', '0' => 'No'))); ?>
    <?php echo $this->Form->end(array("label" => "Guardar", "class" => "submit_button")) ?>
</fieldset>
