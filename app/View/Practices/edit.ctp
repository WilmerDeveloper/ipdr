<script>


    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#practice"
                });
            }
        });  }
        
)
        
</script>
<div id="practice">
    <?php echo $this->Form->create("Practice", array("id" => "formulario", "action" => "edit/" . $this->data['Practice']['id'])); ?>
    <?php echo $this->Form->input('Practice.id'); ?>
    <?php echo $this->Form->input('Practice.tipo', array('label' => '5.14. ¿Cuáles prácticas realiza en sus cultivos y productos?', 'class' => 'required', 'empty' => '', 'options' => array('Buenas Prácticas Agrícolas (BPA)' => 'Buenas Prácticas Agrícolas (BPA)', 'Mejoramiento de semillas, razas, especies' => 'Mejoramiento de semillas, razas, especies', 'Fertilización Orgánica' => 'Fertilización Orgánica', 'Fertilización Química' => 'Fertilización Química', 'Producción limpia' => 'Producción limpia', 'Conservación de recursos naturales' => 'Conservación de recursos naturales', 'Labranza minima' => 'Labranza mínima '))); ?>
    <?php echo $this->Form->hidden('Practice.productive_poll_id', array('label' => '', 'class' => '')); ?>
    <?php echo $this->Form->end("Guardar") ?>
</div>
