<script>


    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#control"
                });
            }
        });  }
        
)
        
</script>
<div id="control">
    <fieldset>
        <?php echo $this->Form->create("PropertyControl", array("id" => "formulario", "action" => "add/" . $property_id)); ?>
        <?php echo $this->Form->hidden('PropertyControl.property_id',array('value'=>$property_id)); ?>
        <?php echo $this->Form->input('PropertyControl.formulario', array('label' => '0. Número de Formulario', 'class' => 'required', 'type' => 'number')); ?>
        <?php echo $this->Form->input('PropertyControl.nombre_aliado', array('label' => '1.1 Nombre del Aliado estratégico:', 'class' => 'required')); ?>
        <?php echo $this->Form->input('PropertyControl.nombre_encuestador', array('label' => '1.2 Nombre del encuestador:', 'class' => 'required')); ?>
        <?php echo $this->Form->input('PropertyControl.documento_encuestador', array('label' => '1.3 Documento de Identidad:', 'class' => 'required', 'type' => 'number')); ?>
        <?php echo $this->Form->input('PropertyControl.fecha_entrevista', array('label' => '1.4 Fecha de la entrevista', 'class' => 'calendario', 'type' => 'required')); ?>
        <?php echo $this->Form->input('PropertyControl.numero_visitas', array('label' => '1.5 Número de visitas', 'class' => 'required', 'type' => 'number')); ?>
        <?php echo $this->Form->end("Guardar") ?>
    </fieldset>
</div>
