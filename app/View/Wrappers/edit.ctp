<script>


    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#empaque"
                });
            }
        });  }
        
)
        
</script>
<div id="empaque">
    <fieldset><legend>5.17 ¿Utiliza algún empaque o embalaje?</legend>
        <?php echo $this->Form->create("Wrapper", array("id" => "formulario", "action" => "edit/" . $this->data['Wrappers']['id'])); ?>
        <?php echo $this->Form->input('Wrapper.id'); ?>
        <?php echo $this->Form->input('Wrapper.tipo', array('label' => 'Indique el tipo de Empaque', 'class' => 'required', 'empty' => '', 'options' => array('Canastilla' => 'Canastilla', 'Costal' => 'Costal', 'Guacal' => 'Guacal', 'Bolsa' => 'Bolsa', 'Granel' => 'Granel', 'Otro ' => 'Otro ',))); ?>
        <?php echo $this->Form->hidden('Wrapper.productive_poll_id'); ?>
        <?php echo $this->Form->end("Guardar") ?>
    </fieldset>
</div>
