<script>
    $(".cal").datepicker(
            {
                dateFormat: 'yy/mm/dd',
                buttonImageOnly: true
            }
    );

</script>
<fieldset>
    <?php echo $this->Form->create("FamilyPoll", array('class' => 'form', "action" => "add/" . $beneficiary_id)); ?>

    <fieldset> <legend>I. CONTROL OPERATIVO</legend>
        <?php echo $this->Form->hidden('FamilyPoll.id'); ?>
        <?php echo $this->Form->hidden('FamilyPoll.beneficiary_id', array('value' => $beneficiary_id, 'type' => 'text')); ?>
        <?php echo $this->Form->hidden('FamilyPoll.sincronizado', array('value' => 0, 'type' => 'text')); ?>
        <?php echo $this->Form->input('FamilyPoll.property_id', array('label' => 'Predio', 'empty' => 'Seleccione predio', 'class' => 'required')); ?>
        <?php // echo $this->Form->input('FamilyPoll.nombre_aliado', array('label' => '1.1 Nombre del Aliado estratégico:', 'class' =>'')); ?>
        <?php echo $this->Form->input('FamilyPoll.nombre_encuestador', array('label' => '1.2 Nombre del encuestador:', 'class' => '')); ?>
        <?php echo $this->Form->input('FamilyPoll.documento_encuestador', array('label' => '1.3 Documento de Identidad:', 'class' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('FamilyPoll.fecha_entrevista', array('label' => '1.4 Fecha de la Entrevista', 'class' => 'cal', 'type' => '')); ?>
        <?php echo $this->Form->input('FamilyPoll.numero_visitas', array('label' => '1.5 Número de visitas', 'class' => '', 'type' => 'number')); ?>
    </fieldset>
    <fieldset> <legend>II. IDENTIFICACIÓN</legend>
        <?php echo $this->Form->input('FamilyPoll.codigo_formulario', array('label' => 'Código formulario', 'class' => '')); ?>
        <?php echo $this->Form->input('FamilyPoll.nombre_encuestado', array('label' => '2.2 Nombre del encuestado:', 'class' => '')); ?>
        <?php echo $this->Form->input('FamilyPoll.documento_encuestado', array('label' => '2.3 Documento de Identidad:', 'class' => '')); ?>
        <?php echo $this->Form->input('FamilyPoll.telefono_fijo', array('label' => '2.4 Teléfono Fijo', 'class' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('FamilyPoll.tefono_celular', array('label' => '2.5 Teléfono Móvil', 'class' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('FamilyPoll.correo_electronico', array('label' => '2.6 Correo Electrónico', 'type' => 'email')); ?>
        <?php echo $this->Form->input('FamilyPoll.ubicacion_residencia', array('label' => '2.7 Ubicación del lugar de residencia:', 'class' => '', 'empty' => '', 'options' => array('Fuera del predio' => 'Fuera del predio', 'Dentro del predio' => 'Dentro del predio'))); ?>
        <?php echo $this->Form->input('FamilyPoll.vereda', array('label' => '2.8 Vereda:', 'class' => '', 'empty' => '')); ?>
        <?php echo $this->Form->input('FamilyPoll.corregimiento', array('label' => ' 2.9 Corregimiento:', 'class' => '', 'empty' => '')); ?>

        <?php
        echo $this->Ajax->observeField('FamilyPollDepartamentId', array(
            'url' => array('controller' => 'FamilyPolls', 'action' => 'get_city'),
            'frequency' => 0.2,
            'update' => 'ciudades',
                )
        );
        echo $this->Form->input('FamilyPoll.departament_id', array('label' => '2.10a Departamento', 'class' => 'required', 'empty' => 'Seleccione Departamento'));
        ?>
        <div id="ciudades">
            <?php echo $this->Form->input('FamilyPoll.city_id', array('class' => 'required', 'label' => '2.10b Municipio', 'class' => 'required', 'empty' => 'Seleccione Municipio o Ciudad')); ?>
        </div>
        <?php
        echo $this->Ajax->observeField('FamilyPollTipoPoblacion', array(
            'url' => array('controller' => 'FamilyPolls', 'action' => 'desplazados'),
            'frequency' => 0.2,
            'update' => 'dp',
                )
        );
        echo $this->Form->input('FamilyPoll.tipo_poblacion', array('label' => '2.11 Tipo de población', 'class' => '', 'empty' => '', 'options' => array('Campesino' => 'Campesino', 'Desplazado' => 'Desplazado')));
        ?>
        <div id="dp">
        </div>
        <?php echo $this->Form->input('FamilyPoll.grupo_poblacion', array('label' => '2.12 Grupo al cual pertenece el hogar :', 'class' => '', 'empty' => '', 'options' => array('Mujeres cabeza de hogar' => 'Mujeres cabeza de hogar', 'Indígenas' => 'Indígenas', 'Negritudes' => 'Negritudes', 'Rom' => 'Rom'))); ?>
        <?php echo $this->Form->input('FamilyPoll.etnia', array('label' => 'Etnia', 'class' => '')); ?>
        <?php echo $this->Form->input('FamilyPoll.vulnerabilidad', array('label' => '2.14 ¿Su familia está en condición de vulnerabilidad', 'class' => '', 'empty' => '', 'options' => array('No' => 'No', 'Desplazamiento' => 'Desplazamiento', 'Estrato uno o dos' => 'Estrato uno o dos', 'Ola invernal' => 'Ola invernal', 'Orden público' => 'Orden público'))); ?>
        <?php echo $this->Form->input('FamilyPoll.observaciones', array('label' => 'Observaciones', 'class' => '')); ?>
    </fieldset>

    <?php echo $this->Form->end("Guardar") ?>
</fieldset>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'FamilyPolls', 'action' => 'index', $beneficiary_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>