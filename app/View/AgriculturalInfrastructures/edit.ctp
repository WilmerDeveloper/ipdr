
<script>

    $(document).ready(function() {


        jQuery("#formularioEstr").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#infrastructura",
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
    <?php echo $this->Form->create("AgriculturalInfrastructure", array("id" => "formularioEstr", 'url' => array('controller' => 'AgriculturalInfrastructures', "action" => "edit", $this->data['AgriculturalInfrastructure']['id']))); ?>
    <?php echo $this->Form->input('AgriculturalInfrastructure.tipo', array('label' => 'Tipo de instalación', 'class' => 'required', 'empty' => '', 'options' => array('trapiche' => 'trapiche', 'semillero' => 'semillero', 'beneficiadero' => 'beneficiadero', 'Invernaderos' => 'Invernaderos', 'Corral / Establo' => 'Corral / Establo'))); ?>
    <?php echo $this->Form->input('AgriculturalInfrastructure.area', array('label' => 'Área (m2 )', 'class' => 'required')); ?>
    <?php echo $this->Form->hidden('AgriculturalInfrastructure.property_id'); ?>
    <?php echo $this->Form->hidden('AgriculturalInfrastructure.id'); ?>
    <?php echo $this->Form->hidden('AgriculturalInfrastructure.sincronizado', array( 'value' => 0)); ?>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>
</fieldset>
