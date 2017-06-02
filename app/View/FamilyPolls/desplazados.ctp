<?php
if ($desplazados == 1):
    ?>
 <fieldset><legend>2.13 Información sobre el desplazamiento: (Sólo para población desplazada)</legend>


    <?php echo $this->Form->input('FamilyPoll.fecha_desplazamiento', array('label' => 'Fecha de Desplazamiento', 'class' => 'calendario')); ?>

    <?php echo $this->Form->input('FamilyPoll.vereda_desplazamiento', array('label' => 'Vereda de desplazamiento', 'class' => 'required')); ?>
    <?php echo $this->Form->input('FamilyPoll.corregimiento_desplazamiento', array('label' => 'Corregimiento de desplazamiento', 'class' => 'required')); ?>
    <?php
    echo $this->Ajax->observeField('FamilyPollDepartamentoDesplazamiento', array(
        'url' => array('controller' => 'FamilyPolls', 'action' => 'get_city'),
        'frequency' => 0.2,
        'update' => 'ciudad2',
            )
    );
    echo $this->Form->input('FamilyPoll.departamento_desplazamiento', array('label' => 'Departamento de desplazamiento', 'class' => 'required', 'options' => $departaments));
    ?>

    <div id="ciudad2">
        <?php echo $this->Form->input('FamilyPoll.ciudad_desplazamiento', array('label' => 'Muncipio o Ciudad de desplazamiento', 'class' => 'required')); ?>

    </div>
</fieldset>
<?php endif; ?>


