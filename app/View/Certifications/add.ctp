<script>


    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#certification"
                });
            }
        });  }
        
)
        
</script>
<div id="certification">
    <fieldset><legend>5.15 ¿Tiene algún tipo de registro o certificación en sus cultivos o productos?</legend>
        <?php echo $this->Form->create("Certification", array("id" => "formulario", "action" => "add/" . $productive_poll_id)); ?>
        <?php echo $this->Form->input('Certification.id', array('label' => '', 'class' => '')); ?>
        <?php echo $this->Form->input('Certification.entidad', array('label' => 'Entidad', 'class' => 'required')); ?>
        <?php echo $this->Form->input('Certification.nombre_certificacion', array('label' => 'Nombre de la certifiacción', 'class' => 'required')); ?>
        <?php echo $this->Form->input('Certification.fecha_inicio', array('label' => 'Fecha de la certificación', 'class' => 'calendario', 'type' => 'required')); ?>
        <?php echo $this->Form->input('Certification.fecha_fin', array('label' => 'Fecha de vencimiento de la certificación', 'class' => 'calendario', 'type' => 'required')); ?>
        <?php echo $this->Form->hidden('Certification.productive_poll_id', array('value' => $productive_poll_id)); ?>
        <?php echo $this->Form->end("Guardar") ?>
    </fieldset>
</div>
