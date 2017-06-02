<script>


    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#devices"
                });
            }
        });  }
        
)
        
</script>
<div id="devices">
    <?php echo $this->Form->create("Device", array("id" => "formulario", "action" => "add/" . $home_id)); ?>
    <?php echo $this->Form->input('Device.name', array('label' => 'Tipo', 'class' => 'required', 'empty' => '', 'options' => array('Radio' => 'Radio', 'Televisor' => 'Televisor', 'Equipo de sonido' => 'Equipo de sonido', 'Modém internet' => 'Modém internet', 'Refrigerador' => 'Refrigerador', 'Estufa a gas' => 'Estufa a gas', 'Teléfono celular' => 'Teléfono celular', 'Computador' => 'Computador', 'Bicicleta' => 'Bicicleta', 'Motocicleta' => 'Motocicleta', 'Automovil/Camión' => 'Automovil/Camión','Otro'=>'Otro'))); ?>
    <?php echo $this->Form->input('Device.cantidad', array('label' => 'Cantidad', 'class' => 'required')); ?>
    <?php echo $this->Form->hidden('Device.home_id', array('type' => 'text', 'value' => $home_id)); ?>
    <?php echo $this->Form->input('Device.otro', array('label' => 'otro ¿Cuál?', 'class' => '')); ?>
    <?php echo $this->Form->end("Guardar") ?>
</div>
