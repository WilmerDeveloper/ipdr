<script>

    $(document).ready(function() {


        jQuery("#fbene").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#generalidades"
                });
            }
        });
    }

    )
</script>
<div>
    <fieldset>
        <?php echo $this->Form->create("Beneficiary", array("id" => "fbene", 'url' => array('controller' => 'Beneficiaries', "action" => "edit_generalidades", $this->data['Beneficiary']['id']))); ?>
        <?php echo $this->Form->hidden('Beneficiary.sincronizado', array('value' => 0)); ?>

        <table border="1">

            <tbody>
                <tr>
                    <td>Nombre del Propietario Cabeza de Familia o Jefe:<?php echo $this->Form->input('Beneficiary.nombres', array('label' => '')); ?></td>
                    <td>Primer_apellido: <?php echo $this->Form->input('Beneficiary.primer_apellido', array('label' => 'primer_apellido')); ?> </td>
                    <td>Tipo de identificaion: <?php echo $this->Form->input('Beneficiary.tipo_identificacion', array('label' => '')); ?></td>
                </tr>
                <tr>
                    <td>Número de identificaion: <?php echo $this->Form->input('Beneficiary.numero_identificacion', array('label' => '')); ?></td>
                    <td>Sexo: <?php echo $this->Form->input('Beneficiary.genero', array('label' => '')); ?></td>
                    <td>Edad: <?php echo $this->Form->input('Beneficiary.edad', array('label' => '')); ?></td>

                </tr>
                <tr>
                    <td> Teléfono fijo :<?php echo $this->Form->input('Beneficiary.telefono', array('label' => '')); ?></td>
                    <td>Celular: <?php echo $this->Form->input('Beneficiary.celular', array('label' => '')); ?></td>
                    <td>Correo electrónico: <?php echo $this->Form->input('Beneficiary.email', array('label' => '')); ?></td>
                </tr>
                <tr>
                    <td>Lugar de residencia del propietario del predio: <?php echo $this->Form->input('Beneficiary.lugar_residencia', array('label' => '')); ?></td>
                    <td>Tiempo de residencia en el predio: <?php echo $this->Form->input('Beneficiary.tiempo_residencia', array('label' => '')); ?></td>
                    <td>Número de personas que conforman el hogar:<?php echo $this->Form->input('Beneficiary.numero_personas', array('label' => '')); ?></td>
                </tr>

            </tbody>
        </table>
        <?php echo $this->Form->input('Beneficiary.id'); ?>
<?php echo $this->Form->end("Guardar") ?>
    </fieldset>
</div>