<script>
    $(document).ready(function(){
        
        $('.form').validate();
        
    })
</script>
<fieldset>
    <?php echo $this->Form->create("Beneficiary", array("class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "add", $property_id, $beneficiary_id, $redirect))); ?>
    <?php echo $this->Form->hidden('Beneficiary.sincronizado', array('value' => 0)); ?>
    <?php echo $this->Form->input('Beneficiary.tipo_identificacion', array('label' => 'Tipo identificación', 'class' => 'required', 'empty' => '', 'options' => array('C.C' => 'C.C', 'NIT' => 'NIT', 'T.I' => 'T.I', 'NUI' => 'NUI'))); ?>
    <?php echo $this->Form->input('Beneficiary.numero_identificacion', array('label' => 'Número identificación', 'class' => 'required', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Beneficiary.nombres', array('label' => 'Nombres', 'class' => '')); ?>
    <?php echo $this->Form->input('Beneficiary.primer_apellido', array('label' => 'Primer apellido', 'class' => '')); ?>
    <?php echo $this->Form->input('Beneficiary.segundo_apellido', array('label' => 'Segundo apellido', 'class' => '')); ?>
    <?php echo $this->Form->input('Beneficiary.genero', array('label' => 'Género', 'class' => '', 'empty' => '', 'options' => array('Masculino' => 'Masculino', 'Femenino' => 'Femenino'))); ?>
    <?php echo $this->Form->input('Beneficiary.tipo', array('label' => 'Tipo beneficiario', 'class' => 'required', 'empty' => '', 'options' => array('Campesino' => 'Campesino', 'Desplazado' => 'Desplazado', 'Indigena' => 'Indigena', 'Rom' => 'Rom', 'Negritudes' => 'Negritudes', 'Mujer cabeza de familia' => 'Mujer cabeza de familia'))); ?>
    <?php echo $this->Form->input('Beneficiary.fecha_nacimiento', array('label' => 'Fecha nacimiento', 'class' => 'calendario', 'type' => 'text')); ?>
    <?php echo $this->Form->input('Beneficiary.numero_resolucion', array('label' => 'Número de la resolución de adjudicación', 'class' => '')); ?>
    <?php echo $this->Form->input('Beneficiary.fecha_resolucion', array('label' => 'Fecha  la resolucion de adjudicación', 'class' => 'calendario', 'type' => 'text')); ?>
    <?php echo $this->Form->input('Beneficiary.telefono', array('label' => 'Teléfono', 'class' => '')); ?>
    <?php echo $this->Form->input('Beneficiary.direccion', array('label' => 'Dirección', 'class' => '')); ?>
    <?php echo $this->Form->input('Beneficiary.sisben_area', array('label' => 'Área SISBEN', 'class' => 'required')); ?>
    <?php echo $this->Form->input('Beneficiary.sisben_puntaje', array('label' => 'Puntaje SISBEN', 'class' => 'required')); ?>
    <table border="0">
        <tbody>
            <tr>
                <td>Adjuntar documento de identidad</td>
                <td><?php echo $this->Form->file('Beneficiary.cedula', array('label' => 'Adjuntar cédula', 'accept' => 'pdf', 'class' => 'required')); ?></td>
            </tr>
            <tr>
                <td>Adjuntar certificado policía</td>
                <td><?php echo $this->Form->file('Beneficiary.policia', array('label' => 'Adjuntar cédula', 'accept' => 'pdf', 'class' => 'required')); ?></td>
            </tr>
            <tr>
                <td>Adjuntar certificado contraloría</td>
                <td><?php echo $this->Form->file('Beneficiary.contraloria', array('label' => 'Adjuntar cédula', 'accept' => 'pdf', 'class' => 'required')); ?></td>
            </tr>

            <tr>
                <td>Adjuntar certificado procuraduría</td>
                <td><?php echo $this->Form->file('Beneficiary.procuraduria', array('label' => 'Adjuntar cédula', 'accept' => 'pdf', 'class' => 'required')); ?></td>
            </tr>
        </tbody>
    </table>
    <?php echo $this->Form->hidden('Beneficiary.property_id', array('label' => 'property_id', 'value' => $property_id)); ?>
    <?php echo $this->Form->hidden('Beneficiary.beneficiary_id', array('value' => $beneficiary_id)); ?>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submitButton')) ?>
</fieldset>