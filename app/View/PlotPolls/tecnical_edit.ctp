<script>

    $(document).ready(function() {


        jQuery("#ast").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#asistencia",
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
    <?php echo $this->Form->create("PlotPoll", array("id" => "ast", "url" => array("action" => "tecnical_edit", $this->data['PlotPoll']['id']))); ?>
    <?php echo $this->Form->hidden('PlotPoll.id'); ?>
    <?php echo $this->Form->input('PlotPoll.asistencia_tecnica', array('label' => '¿Recibe asistencia técnica?', 'class' => 'required', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
    <?php echo $this->Form->input('PlotPoll.entidad_asistencia', array('label' => 'Que entidad presta asistencia', 'class' => '')); ?>
    <?php echo $this->Form->input('PlotPoll.frecuencia_visita_tecnica', array('label' => '¿Cuantas visitas por año recibe?', 'class' => 'required')); ?>
    <?php echo $this->Form->end(array("label" => "Guardar", "class" => "submit_button")) ?>
</fieldset>