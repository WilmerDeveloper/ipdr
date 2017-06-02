
<script>

    $(document).ready(function() {
        $(".calendario").datepicker({
            showOn: 'both',
            buttonImage: './img/calendar.jpg',
            buttonImageOnly: true,
            changeYear: true,
            numberOfMonths: 1

        });

        jQuery("#frm1").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#estado",
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
    <?php echo $this->Form->create("PlotPoll", array("id" => "frm1", "url" => array("action" => "edit_state", $this->data['PlotPoll']['id']))); ?>
    <?php echo $this->Form->hidden('PlotPoll.id'); ?>
    <?php echo $this->Form->input('PlotPoll.incumplimiento', array('label' => '¿Se observa alguna causal de incumplimiento con las condiciones de régimen parcelario?  ', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
    <?php echo $this->Form->input('PlotPoll.acciones_de_mejora', array('label' => 'ACCIONES  DE MEJORA Y SEGUIMIENTO ', 'class' => '')); ?>
    <?php echo $this->Form->input('PlotPoll.resultado', array('label' => 'RESULTADO ACCIONES  DE MEJORA Y SEGUIMIENTO ', 'class' => '')); ?>
    <?php echo $this->Form->input('PlotPoll.fecha_ultima_visita', array('label' => 'FECHA DE ÚLTIMA VISITA DE SEGUIMIENTO ', 'class' => 'calendario', 'type' => 'text')); ?>
   <br>
   <br>
   <fieldset style="border: solid 1px"><h1>Tipologías</h1>

        <?php echo $this->Form->input('PlotPoll.tipologia_ambiental', array('label' => 'Ambiental', 'class' => '')); ?>
        <?php echo $this->Form->input('PlotPoll.tipologia_juridica', array('label' => 'Juridica', 'class' => '')); ?>
        <?php echo $this->Form->input('PlotPoll.otra_tipologia', array('label' => 'Otra', 'class' => '')); ?>
        <?php echo $this->Form->input('PlotPoll.tipologia_social', array('label' => 'Social', 'class' => '')); ?>
    </fieldset>
    <?php echo $this->Form->end(array("label" => "Guardar", "class" => "submit_button")) ?>
</fieldset>
