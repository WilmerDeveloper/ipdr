<script>


    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#consumo"
                });
            }
        });  }
        
)
        
</script>
<div id="consumo">
    <fieldset>
        <?php echo $this->Form->create("Consumption", array("id" => "formulario", "action" => "edit/" . $this->data['Consumption']['id'])); ?>
        <?php echo $this->Form->hidden('Consumption.id'); ?>
        <?php echo $this->Form->hidden('Consumption.productive_poll_id'); ?>
        <?php echo $this->Form->input('Consumption.productive_activity_id', array('label' => 'Producto', 'class' => 'required')); ?>
        <?php echo $this->Form->input('Consumption.consumo_estimado', array('label' => 'Consumo estimado/año', 'class' => '')); ?>
        <?php echo $this->Form->input('Consumption.porcentaje_cosecha', array('label' => 'Porcentaje de Cosecha Utilizado (%)', 'class' => 'required', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Consumption.unidad_medida', array('label' => 'Unidad de Medida', 'options' => array('Tonelada' => 'Tonelada', 'Kilogramo' => 'Kilogramo', 'Bultos' => 'Bultos', 'Litros' => 'Litros'), 'class' => 'required')); ?>
        <?php echo $this->Form->end("Guardar") ?>
    </fieldset>
</div>
