<script>


    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#convenios"
                });
            }
        });  }
        
)
        
</script>
<div id="convenios">
    <?php echo $this->Form->create("Convention", array("id" => "formulario", "action" => "edit/" . $this->data['Convention']['id'])); ?>
    <?php echo $this->Form->input("Convention.id"); ?>
    <?php echo $this->Form->input('Convention.tipo', array('label' => 'Tipo', 'class' => 'required')); ?>
    <?php echo $this->Form->input('Convention.institucion', array('label' => 'Institución', 'class' => 'required')); ?>
    <?php echo $this->Form->hidden('Convention.asociation_id'); ?>
    <?php echo $this->Form->end("Guardar") ?>
</div>