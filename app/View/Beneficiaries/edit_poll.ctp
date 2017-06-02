<fieldset>
    <?php echo $this->Form->create("Beneficiary", array('class' => 'form', "action" => "edit_poll/" . $this->data['Beneficiary']['id'])); ?>


    <fieldset><legend>III DATOS DEL HOGAR</legend>
        <?php echo $this->Form->hidden('Beneficiary.family_poll_id'); ?>
        <?php echo $this->Form->hidden('Beneficiary.sincronizado', array('value' => 0)); ?>
        <?php echo $this->Form->hidden('Beneficiary.id', array('type' => 'text')); ?>
        <?php echo $this->Form->input('Beneficiary.tipo_identificacion', array('label' => 'Tipo identificación', 'class' => 'required', 'empty' => '', 'options' => array('C.C' => 'C.C', 'T.I' => 'T.I', 'NUI' => 'NUI'))); ?>
        <?php echo $this->Form->input('Beneficiary.numero_identificacion', array('label' => 'Número identificación', 'class' => 'required', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Beneficiary.nombres', array('empty' => '', 'label' => '3.1.1 Primer Nombre', 'class' => 'required')); ?>
        <?php echo $this->Form->input('Beneficiary.primer_apellido', array('empty' => '', 'label' => '3.1.1 Primer apellido', 'class' => 'required')); ?>
        <?php echo $this->Form->input('Beneficiary.segundo_apellido', array('empty' => '', 'label' => '3.1.1 Segundo Apellido', 'class' => '')); ?>
        <?php echo $this->Form->input('Beneficiary.genero', array('label' => 'Género', 'class' => '', 'empty' => '', 'options' => array('Masculino' => 'Masculino', 'Femenino' => 'Femenino'))); ?>
        <?php echo $this->Form->input('Beneficiary.edad', array('empty' => '', 'label' => '3.1.3 Edad', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Beneficiary.estado_civil', array('empty' => '', 'label' => '3.1.5 Estado civil', 'class' => '', 'options' => array('Soltero' => 'Soltero(a)', 'Casado' => 'Casado(a)', 'Union libre' => 'Unión libre', 'Viudo' => 'Viudo(a)', 'Divorciado' => 'Divorciado(a)'))); ?>
        <?php echo $this->Form->input('Beneficiary.ocupacion', array('empty' => '', 'label' => '3.1.6 Ocupación', 'class' => '', 'options' => array('Agricultor' => 'Agricultor', 'Ganadero' => 'Ganadero', 'Comerciante' => 'Comerciante', 'Artesano' => 'Artesano', 'Ama de casa' => 'Ama de casa', 'Estudiante' => 'Estudiante', 'Desempleado' => 'Desempleado', 'Pensionado' => 'Pensionado', 'Otro'))); ?>
        <?php echo $this->Form->input('Beneficiary.escolaridad', array('empty' => '', 'label' => '3.1.7 Escolaridad', 'class' => 'required', 'options' => array('Ninguna' => 'Ninguna', 'Primaria' => 'Primaria', 'Secundaria' => 'Secundaria', 'Técnico' => 'Técnico', 'Tecnólogo' => 'Tecnólogo', 'Universitario' => 'Universitario'))); ?>
        <?php echo $this->Form->input('Beneficiary.seguridad_social', array('empty' => '', 'label' => '3.1.8 Seguridad Social', 'class' => '', 'options' => array('Cotizante regimen contributivo' => 'Cotizante régimen contributivo', 'Beneficiario regimen contributivo' => 'Beneficiario régimen contributivo', 'Sisben' => 'Rég. Subsidiado (Sisben)', 'Otro' => 'Otro', 'Ninguno' => 'Ninguno'))); ?>
        <?php echo $this->Form->input('Beneficiary.nivel_sisben', array('empty' => '', 'label' => '3.1.9 Nivel Sisben', 'class' => 'numeric')); ?>
        <?php echo $this->Form->input('Beneficiary.prestadora_salud', array('empty' => '', 'label' => '3.1.10 EPS O ARS', 'class' => '')); ?>
        <?php echo $this->Form->input('Beneficiary.discapacidad', array('empty' => '', 'label' => '3.1.11 Enfermedad o Discapacidad', 'class' => '')); ?>

    </fieldset>
    <?php echo $this->Form->end("Guardar") ?>   
</fieldset>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Beneficiaries', 'action' => 'poll_index', $this->data['Beneficiary']['property_id']), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>