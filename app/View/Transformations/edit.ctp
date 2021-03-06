<script>


    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#transformation"
                });
            }
        });  }
        
)
        
</script>
<div id="transformation">
    <fieldset><legend>5.16. ¿Realiza algún tipo de transformación a sus productos?</legend>
        <?php echo $this->Form->create("Transformation", array("id" => "formulario", "action" => "edit/" . $this->data['Transformation']['id'])); ?>
        <?php echo $this->Form->input('Transformation.id'); ?>
        <?php echo $this->Form->input('Transformation.tipo', array('label' => 'Transformación', 'class' => 'required', 'empty' => '', 'options' => array('Selección y empaque' => 'Selección y empaque', 'Secado' => 'Secado', 'Molido o picado' => 'Molido o picado', 'Estandarización de calidad' => 'Estandarización de calidad', 'Pelado' => 'Pelado', 'Deshidratación' => 'Deshidratación', 'Elaboración de harinas' => 'Elaboración de harinas', 'Lavado' => 'Lavado', 'Limpieza' => 'Limpieza', 'Encerado ' => 'Encerado ',))); ?>
        <?php echo $this->Form->hidden('Transformation.productive_poll_id', array('class' => '')); ?>
        <?php echo $this->Form->end("Guardar") ?>
    </fieldset>

</div>
