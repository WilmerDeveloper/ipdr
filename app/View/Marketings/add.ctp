<script>

    $(document).ready(function() {


        jQuery("#formularioMark").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#comercializacion",
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
    <?php echo $this->Form->create("Marketing", array("id" => "formularioMark", 'url' => array('controller' => 'Marketings', "action" => "add", $productive_baseline_id))); ?>
    <?php echo $this->Form->input('Marketing.tipo', array('label' => 'Tipo de canal', 'class' => 'required', 'empty' => '', 'options' => array('Asociación' => 'Asociación', 'Plaza de mercado' => 'Plaza de mercado', 'Intermediario' => 'Intermediario', 'Almacén de cadena' => 'Almacén de cadena', 'Tienda' => 'Tienda', 'Restaurante' => 'Restaurante', 'Industria' => 'Industria', 'Exportador' => 'Exportador', 'Otros' => 'Otros'))); ?>
    <?php echo $this->Form->input('Marketing.nombre_canal', array('label' => 'Nombre del canal', 'class' => '')); ?>
    <?php echo $this->Form->input('Marketing.productive_activity_id', array('label' => 'Producto', 'empty' => '', 'class' => 'required')); ?>
    <?php echo $this->Form->input('Marketing.variedad', array('label' => 'Variedad', 'class' => '')); ?>
    <?php echo $this->Form->input('Marketing.calidad', array('label' => 'Calidad', 'class' => '', 'empty' => '', 'options' => array('De Primera' => 'De Primera', 'De segunda' => 'De segunda', 'De tercera' => 'De tercera'))); ?>
    <?php echo $this->Form->input('Marketing.unidad', array('label' => 'Unidad', 'class' => '')); ?>
    <?php echo $this->Form->input('Marketing.cantidad_unidad', array('label' => 'Cantidad Unidad/Año', 'class' => '')); ?>
    <?php echo $this->Form->input('Marketing.precio_promedio', array('label' => 'Precio promedio unidad', 'class' => '')); ?>
    <?php echo $this->Form->hidden('Marketing.productive_baseline_id', array('label' => 'productive_baseline_id', 'value' => $productive_baseline_id)); ?>
    <?php echo $this->Form->hidden('Marketing.sincronizado', array('value' => 0)); ?>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>
</fieldset>
