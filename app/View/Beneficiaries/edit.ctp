<script>
    $(document).ready(function(){
        
        $('.form').validate();
        
    })
</script>
<fieldset>

    <?php echo $this->Form->create("Beneficiary", array('enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit", $this->data['Beneficiary']['id'], $beneficiary_id, $redirect))); ?>
    <?php echo $this->Form->hidden('Beneficiary.sincronizado', array('value' => 0)); ?>
    <?php if (!empty($properties)) : ?>
        <?php echo $this->Form->input('Beneficiary.property_id'); ?>

    <?php else: ?>
        <?php echo $this->Form->hidden('Beneficiary.property_id'); ?>
    <?php endif; ?>
    <?php echo $this->Form->input('Beneficiary.tipo_identificacion', array('label' => 'Tipo identificación', 'empty' => '', 'options' => array('C.C' => 'C.C', 'NIT' => 'NIT', 'T.I' => 'T.I', 'NUI' => 'NUI'))); ?>
    <?php echo $this->Form->input('Beneficiary.numero_identificacion', array('label' => 'Número identificación', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Beneficiary.nombres', array('label' => 'Nombres', 'class' => '')); ?>
    <?php echo $this->Form->input('Beneficiary.primer_apellido', array('label' => 'Primer apellido', 'class' => '')); ?>
    <?php echo $this->Form->input('Beneficiary.segundo_apellido', array('label' => 'Segundo apellido', 'class' => '')); ?>
    <?php echo $this->Form->input('Beneficiary.genero', array('label' => 'Género', 'class' => '', 'empty' => '', 'options' => array('Masculino' => 'Masculino', 'Femenino' => 'Femenino'))); ?>
    <?php echo $this->Form->input('Beneficiary.tipo', array('label' => 'Tipo beneficiario', 'empty' => '', 'options' => array('Campesino' => 'Campesino', 'Desplazado' => 'Desplazado', 'Indigena' => 'Indigena', 'Rom' => 'Rom', 'Negritudes' => 'Negritudes', 'Mujer cabeza de familia' => 'Mujer cabeza de familia'))); ?>
    <?php echo $this->Form->input('Beneficiary.fecha_nacimiento', array('label' => 'Fecha nacimiento', 'class' => 'calendario', 'type' => 'text')); ?>
    <?php echo $this->Form->input('Beneficiary.numero_resolucion', array('label' => 'Número de la resolución de adjudicación', 'class' => '')); ?>
    <?php echo $this->Form->input('Beneficiary.fecha_resolucion', array('label' => 'Fecha  la resolucion de adjudicación', 'class' => 'calendario', 'type' => 'text')); ?>
    <?php echo $this->Form->input('Beneficiary.telefono', array('label' => 'Teléfono', 'class' => '')); ?>
    <?php echo $this->Form->input('Beneficiary.direccion', array('label' => 'Dirección', 'class' => '')); ?>
    <?php echo $this->Form->input('Beneficiary.sisben_area', array('label' => 'Área SISBEN')); ?>
    <?php echo $this->Form->input('Beneficiary.sisben_puntaje', array('label' => 'Puntaje SISBEN')); ?>
    <?php
    if (AuthComponent::User('group_id') == 1)
        echo $this->Form->input('Beneficiary.beneficiary_id', array('label' => 'cabeza de familia', 'empty' => '0'));
    if (AuthComponent::User('group_id') != 1)
        echo $this->Form->hidden('Beneficiary.beneficiary_id');
    ?>
    <table>
        <tbody>
            <tr>
                <td>Adjuntar documento de identidad</td>
                <td><?php echo $this->Form->file('Beneficiary.cedula', array('label' => 'Adjuntar cédula', 'accept' => 'pdf', 'class' => '')); ?></td>
            </tr>
            <tr>
                <td>Adjuntar certificado policía</td>
                <td><?php echo $this->Form->file('Beneficiary.policia', array('label' => 'Adjuntar cédula', 'accept' => 'pdf')); ?></td>
            </tr>
            <tr>
                <td>Adjuntar certificado contraloría</td>
                <td><?php echo $this->Form->file('Beneficiary.contraloria', array('label' => 'Adjuntar cédula', 'accept' => 'pdf')); ?></td>
            </tr>
            <tr>
                <td>Adjuntar certificado procuraduría</td>
                <td><?php echo $this->Form->file('Beneficiary.procuraduria', array('label' => 'Adjuntar cédula', 'accept' => 'pdf')); ?></td>
            </tr>
            <?php if ($this->data['Beneficiary']['tipo'] == 'Campesino'): ?>
                <tr>
                    <td>Adjuntar archivo SISBEN</td>
                    <td><?php echo $this->Form->file('Beneficiary.sisben', array('label' => 'Adjuntar SISBEN', 'accept' => 'pdf')); ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php echo $this->Form->hidden('Beneficiary.id'); ?>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submitButton')) ?>
</fieldset>
