<script>

    $(document).ready(function() {


        jQuery("#formularioPez").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#peces",
                    beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });
    }

    )
</script>
<div>
    <fieldset>
        <?php echo $this->Form->create("FishInventory", array("id" => "formularioPez", 'url' => array('controller' => 'FishInventories', "action" => "edit", $this->data['FishInventory']['id']))); ?>
        <?php echo $this->Form->input('FishInventory.id', array('label' => 'id', 'class' => '')); ?>
        <?php echo $this->Form->input('FishInventory.area_espejo', array('label' => 'Espejo de agua (Metros)', 'class' => 'required')); ?>
        <?php echo $this->Form->input('FishInventory.alevinos', array('label' => 'Alevinos Sembrados (N°)', 'class' => 'required')); ?>
        <?php echo $this->Form->input('FishInventory.desechos', array('label' => 'Desechos en la parte piscícola:', 'class' => 'required', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
        <?php echo $this->Form->input('FishInventory.manejo_desechos', array('label' => '¿Como los maneja?', 'class' => '')); ?>
        <?php echo $this->Form->hidden('FishInventory.productive_baseline_id'); ?>
        <?php echo $this->Form->hidden('FishInventory.id'); ?>
        <?php echo $this->Form->hidden('FishInventory.sincronizado', array('value' => 0)); ?>
        <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>
    </fieldset>
</div>