
<script>

    $(document).ready(function() {


        jQuery("#formx").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#beneficiarios"
                });
            }
        });
    }

    )
</script>
<fieldset>
    <?php echo $this->Form->create("Beneficiary", array("id" => "formx", "url" => array("action" => "follow_edit", $this->data['Beneficiary']['id']))); ?>
    <?php echo $this->Form->hidden('Beneficiary.id'); ?>
    <?php echo $this->Form->input('Beneficiary.tipo_identificacion', array('label' => 'Tipo identificación', 'class' => 'required')); ?>
    <?php echo $this->Form->input('Beneficiary.numero_identificacion', array('label' => 'Número_identificacion', 'class' => 'required')); ?>
    <?php echo $this->Form->input('Beneficiary.nombres', array('label' => 'Nombres', 'class' => 'required')); ?>
    <?php echo $this->Form->input('Beneficiary.primer_apellido', array('label' => 'Primer apellido', 'class' => 'required')); ?>
    <?php echo $this->Form->input('Beneficiary.segundo_apellido', array('label' => 'Segundo apellido', 'class' => 'required')); ?>
    <?php echo $this->Form->input('Beneficiary.telefono', array('label' => 'Teléfono')); ?>
    <?php echo $this->Form->input('Beneficiary.direccion', array('label' => 'Direccion', 'class' => 'required')); ?>
    <?php echo $this->Form->input('Beneficiary.habitante', array('label' => '¿Es habitante?', 'class' => '', 'empty' => '', 'options' => array('1' => 'Si', '0' => 'No'))); ?>
    <?php echo $this->Form->input('Beneficiary.celular', array('label' => 'Celular', 'class' => '')); ?>
    <?php echo $this->Form->input('Beneficiary.email', array('label' => 'Email', 'type' => 'email')); ?>
    <?php echo $this->Form->end(array("label" => "Guardar", "class" => "submit_button")) ?>
</fieldset>
