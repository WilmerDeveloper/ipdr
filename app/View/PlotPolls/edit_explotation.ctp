<script>

    $(document).ready(function() {
         
$(".calendario").datepicker({
		
            showOn: 'both',
            buttonImage: './img/calendar.jpg',
            buttonImageOnly: true,
            changeYear: true,
            numberOfMonths: 1
                
        });
        jQuery("#exp_edit").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#explotation",
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
    <?php echo $this->Form->create("PlotPoll", array('id' => 'exp_edit', 'url' => array('controller' => 'plotPolls', 'action' => 'edit_explotation', $this->data['PlotPoll']['id']))); ?>

    <?php echo $this->Form->hidden('PlotPoll.id'); ?>
    <?php echo $this->Form->input('PlotPoll.documento_contractual', array('label' => '¿La ejecución del Proyecto productivo está ligada a un documento contractual con el INCODER? ', 'class' => 'required', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
    <?php echo $this->Form->input('PlotPoll.numero_documento_contractual', array('label' => 'Código del proyecto', 'class' => '')); ?>
    <?php echo $this->Form->input('PlotPoll.acuerdo_financiamiento', array('label' => 'Acuerdo de financiamiento No', 'class' => '')); ?>
    <?php echo $this->Form->input('PlotPoll.contrato_operacion', array('label' => 'Contrato de operación y funcionamiento No', 'class' => '')); ?>
    <?php echo $this->Form->input('PlotPoll.fecha_inicio', array('label' => 'Fecha de inicio','type'=>'text', 'class' => 'calendario')); ?>
    <?php echo $this->Form->input('PlotPoll.fecha_terminacion', array('label' => 'Fecha de terminación','type'=>'text', 'class' => 'calendario')); ?>
    <?php echo $this->Form->input('PlotPoll.duracion', array('label' => 'Duración años', 'class' => '')); ?>
    <?php echo $this->Form->input('PlotPoll.familias_beneficiadas', array('label' => 'Número de familias beneficiadas por el Proyecto productivo', 'class' => '')); ?>
    <?php echo $this->Form->input('PlotPoll.tipo_familias', array('label' => 'Población Beneficiaria  ', 'class' => '', 'empty' => '', 'options' => array('Campesino' => 'Campesino', 'Desplazado' => 'Desplazado', 'Indigena' => 'Indigena', 'Rom' => 'Rom'))); ?>
    <?php echo $this->Form->input('PlotPoll.fecha_desembolso', array('label' => 'Fecha acta autorización desembolso', 'type'=>'text','class' => 'calendario')); ?>
    <?php echo $this->Form->input('PlotPoll.valor_desembolzado', array('label' => 'Valor desembolsado', 'class' => '')); ?>
    <?php echo $this->Form->input('PlotPoll.objeto', array('label' => 'Objeto', 'class' => '')); ?>
    <?php echo $this->Form->input('PlotPoll.area_ha', array('label' => 'Área (Parte hectáreas)', 'class' => '')); ?>
    <?php echo $this->Form->input('PlotPoll.area_m', array('label' => 'Área (Parte metros)', 'class' => '')); ?>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>
</fieldset>