<fieldset>
    <?php echo $this->Form->create("Candidate", array('class' => 'form', "action" => "add/" . $poll_id)); ?>

    
    <fieldset><legend>III DATOS DEL HOGAR</legend>
        <?php echo $this->Form->hidden('Candidate.family_poll_id', array('value'=>$poll_id)); ?>
        <?php echo $this->Form->input('Candidate.primer_nombre', array('empty' => '', 'label' => '3.1.1 Primer Nombre', 'class' => 'required')); ?>
        <?php echo $this->Form->input('Candidate.segundo_nombre', array('empty' => '', 'label' => '3.1.1 Segundo Nombre', 'class' => '')); ?>
        <?php echo $this->Form->input('Candidate.primer_apellido', array('empty' => '', 'label' => '3.1.1 Primer apellido', 'class' => 'required')); ?>
        <?php echo $this->Form->input('Candidate.segundo_apellido', array('empty' => '', 'label' => '3.1.1 Segundo Apellido', 'class' => '')); ?>
        <?php echo $this->Form->input('Candidate.genero', array('empty' => '', 'label' => '3.1.2 Género', 'class' => 'required', 'options' => array('Hombre' => 'Hombre', 'Mujer' => 'Mujer',))); ?>
        <?php echo $this->Form->input('Candidate.edad', array('empty' => '', 'label' => '3.1.3 Edad', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Candidate.parentesco', array('empty' => '', 'label' => '3.1.4 Parentesco', 'class' => 'required', 'options' => array('Jefe de hogar' => 'Jefe de hogar'))); ?>
        <?php echo $this->Form->input('Candidate.estado_civil', array('empty' => '', 'label' => '3.1.5 Estado civil', 'class' => '', 'options' => array('Soltero' => 'Soltero(a)', 'Casado' => 'Casado(a)', 'Union libre' => 'Unión libre', 'Viudo' => 'Viudo(a)', 'Divorciado' => 'Divorciado(a)'))); ?>
        <?php echo $this->Form->input('Candidate.ocupacion', array('empty' => '', 'label' => '3.1.6 Ocupación', 'class' => '', 'options' => array('Agricultor' => 'Agricultor', 'Ganadero' => 'Ganadero', 'Comerciante' => 'Comerciante', 'Artesano' => 'Artesano', 'Ama de casa' => 'Ama de casa', 'Estudiante' => 'Estudiante', 'Desempleado' => 'Desempleado', 'Pensionado' => 'Pensionado', 'Otro'))); ?>
        <?php echo $this->Form->input('Candidate.escolaridad', array('empty' => '', 'label' => '3.1.7 Escolaridad', 'class' => 'required', 'options' => array('Ninguna' => 'Ninguna', 'Primaria' => 'Primaria', 'Secundaria' => 'Secundaria', 'Técnico' => 'Técnico', 'Tecnólogo' => 'Tecnólogo', 'Universitario' => 'Universitario'))); ?>
        <?php echo $this->Form->input('Candidate.seguridad_social', array('empty' => '', 'label' => '3.1.8 Seguridad Social', 'class' => '', 'options' => array('Cotizante regimen contributivo' => 'Cotizante régimen contributivo', 'Beneficiario regimen contributivo' => 'Beneficiario régimen contributivo', 'Sisben' => 'Rég. Subsidiado (Sisben)', 'Otro' => 'Otro', 'Ninguno' => 'Ninguno'))); ?>
        <?php echo $this->Form->input('Candidate.nivel_sisben', array('empty' => '', 'label' => '3.1.9 Nivel Sisben', 'class' => 'numeric')); ?>
        <?php echo $this->Form->input('Candidate.prestadora_salud', array('empty' => '', 'label' => '3.1.10 EPS O ARS', 'class' => '')); ?>
        <?php echo $this->Form->input('Candidate.discapacidad', array('empty' => '', 'label' => '3.1.11 Enfermedad o Discapacidad', 'class' => '')); ?>
    </fieldset>
    <?php echo $this->Form->end("Guardar") ?>   
</fieldset>
