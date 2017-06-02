<script>


    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#homes"
                });
            }
        });  }
        
)
        
</script>
<div id="homes">
    <?php echo $this->Form->create("PublicService", array("id" => "formulario", "action" => "edit/" . $this->data['PublicService']['id'])); ?>
    <?php echo $this->Form->input('PublicService.name', array('label' => 'Servicio', 'class' => 'required', 'empty' => '', 'options' => array('Ninguno'=>'Ninguno', 'Acueducto' => 'Acueducto', 'Alcantarillado' => 'Alcantarillado', 'Electricidad' => 'Electricidad', 'Telefonía' => 'Telefonía', 'Celular' => 'Celular', 'Pozo séptico' => 'Pozo séptico', 'Internet' => 'Internet', 'Planta eléctrica' => 'Planta eléctrica'))); ?>
    <?php echo $this->Form->input('PublicService.id') ?>
    <?php echo $this->Form->hidden('PublicService.home_id'); ?>
    <?php echo $this->Form->end("Guardar") ?> 
</div>
