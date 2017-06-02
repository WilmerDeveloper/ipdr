<script>

    $(document).ready(function() {


        jQuery("#fbene").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#social"
                });
            }
        });
    }

    )
</script>
<div>
    <fieldset>
        <?php echo $this->Form->create("Beneficiary", array("id" => "fbene", 'url' => array('controller' => 'Beneficiaries', "action" => "social_edit", $this->data['Beneficiary']['id']))); ?>
        <?php echo $this->Form->hidden('Beneficiary.sincronizado', array('value' => 0)); ?>

        <table border="1">

            <tbody>
                <tr>
                    <td>Ocupación:<?php echo $this->Form->input('Beneficiary.ocupacion', array('empty' => '', 'label' => '3.1.6 Ocupación', 'class' => '', 'options' => array('Agricultor' => 'Agricultor', 'Ganadero' => 'Ganadero', 'Comerciante' => 'Comerciante', 'Artesano' => 'Artesano', 'Ama de casa' => 'Ama de casa', 'Estudiante' => 'Estudiante', 'Desempleado' => 'Desempleado', 'Pensionado' => 'Pensionado', 'Otro'))); ?> </td>
                    <td>Escolaridad: <?php echo $this->Form->input('Beneficiary.escolaridad', array('empty' => '', 'label' => '3.1.7 Escolaridad', 'class' => 'required', 'options' => array('Ninguna' => 'Ninguna', 'Primaria' => 'Primaria', 'Secundaria' => 'Secundaria', 'Técnico' => 'Técnico', 'Tecnólogo' => 'Tecnólogo', 'Universitario' => 'Universitario'))); ?></td>
                    <td>Enfermedad  o Discapacidad <?php echo $this->Form->input('Beneficiary.discapacidad', array('label' => '', 'options' => array('empty' => '', 'Ninguna' => 'Ninguna', 'Física' => 'Física', 'Cognitiva' => 'Cognitiva', 'Sensorial' => 'Sensorial', 'Intelectual' => 'Intelectual'))) ?></td>
                </tr>
                <tr>
                    <td>Afiliación en salud:          <?php echo $this->Form->input('Beneficiary.seguridad_social', array('empty' => '', 'label' => '', 'class' => '', 'options' => array('Ninguno' => 'Ninguno', 'Prepagada' => 'Prepagada', 'Cotizante regimen contributivo' => 'Cotizante régimen contributivo', 'Beneficiario regimen contributivo' => 'Beneficiario régimen contributivo', 'Sisben' => 'Rég. Subsidiado (Sisben)', 'Otro' => 'Otro', 'Ninguno' => 'Ninguno'))); ?></td>
                    <td>Nivel sisben <?php echo $this->Form->input('Beneficiary.nivel_sisben', array('label' => '')) ?></td>
                    <td> </td>
                    <td></td>
                </tr>


        
            </tbody>
        </table>
        <?php echo $this->Form->input('Beneficiary.id'); ?>
<?php echo $this->Form->end("Guardar") ?>
    </fieldset>
</div>