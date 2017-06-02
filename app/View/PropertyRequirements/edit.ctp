<script>
    $(function() {
        $("#formpredios").validate({
            submitHandler: function(form) {
                $(form).ajaxSubmit({
                    target: "#predios",
                    beforeSubmit: function() {
                        $(".submit_button").hide();
                    }
                });
            }
        });
    }
    );
</script>
<fieldset><legend>   <?php echo $this->data['InitialRequirement']['texto'] ?></legend>
    <?php echo $this->Form->create("PropertyRequirement", array("id" => "formpredios", "action" => "edit")); ?>
    <?php echo $this->Form->hidden('PropertyRequirement.id'); ?>
    <?php echo $this->Form->input('PropertyRequirement.id', array('label' => 'id', 'class' => '')); ?>
    <?php echo $this->Form->input('PropertyRequirement.calificacion', array('label' => 'calificación', 'class' => 'required', 'empty' => '', 'options' => array('Cumple' => 'Cumple', 'No cumple' => 'No cumple'))); ?>
    <?php echo $this->Form->input('PropertyRequirement.concepto', array('label' => 'concepto', 'class' => 'required')); ?>
    <?php echo $this->Form->hidden('PropertyRequirement.initial_requirement_id', array('label' => 'initial_requirement_id', 'class' => '')); ?>
    <?php echo $this->Form->hidden('PropertyRequirement.property_id'); ?>
    <?php echo $this->Form->hidden('PropertyRequirement.sincronizado', array('value' => 0)); ?>
    <table border="0" style="width: 40%">

        <tbody>
            <tr>
                <td>  <?php echo $this->Form->end(array('label' => "Guardar y continuar", 'class' => 'submitButton','div'=>false)) ?></td>
                <td><br>
                    <?php echo $this->Ajax->link("Regresar al listado", array('controller' => 'PropertyRequirements', "action" => "index", $this->data['PropertyRequirement']['property_id']), array('update' => 'predios', 'indicator' => 'loading', 'class' => 'acciones')) ?>

                </td>
            </tr>
            
        </tbody>
    </table>



</fieldset>
