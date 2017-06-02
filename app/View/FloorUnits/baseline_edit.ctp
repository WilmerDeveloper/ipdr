<script>

    $(document).ready(function() {


        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#unidad",
                    beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });
    }

    )
</script>
<div id="unidad">
    <fieldset><legend></legend>
        <?php echo $this->Form->create("FloorUnit", array('id' => 'formulario', 'url' => array("action" => "baseline_edit", $this->data['FloorUnit']['id']))); ?>
        <?php echo $this->Form->hidden('FloorUnit.id') ?>  
        <?php echo $this->Form->hidden('FloorUnit.sincronizado',array('value'=>0)) ?>  
        <?php echo $this->Form->hidden('FloorUnit.property_id') ?>   
        <?php echo $this->Form->input('FloorUnit.textura', array('options' => array('empty' => '', 'Arenoso' => 'Arenoso', 'Arenoso franco' => 'Arenoso franco', 'Arcilloso' => 'Arcilloso', 'Arcilloso arenoso' => 'Arcilloso arenoso', 'Arcilloso limoso' => 'Arcilloso limoso', 'Franco' => 'Franco', 'Franco arcilloso' => 'Franco arcilloso', 'Franco arenoso' => 'Franco arenoso', 'Franco limoso' => 'Franco limoso', 'limoso' => 'limoso'), 'label' => 'Textura', 'class' => 'required')); ?>
<?php echo $this->Form->end(array('label'=> "Guardar" ,'class'=>'submit_button')) ?>
    </fieldset>
</div>