<?php foreach ($FamilyPolls as $FamilyPoll) :
    ?>

    <table border="1" style="font-size: smaller">

        <tbody>
            <tr>
                <th colspan="3">Tipo:de poblacion</th>
            </tr>
            <tr>
                <td colspan="2">
                    <?php echo $FamilyPoll['FamilyPoll']['tipo_poblacion'] ?> 
                </td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'FamilyPolls', 'action' => 'edit_asociation', $FamilyPoll['FamilyPoll']['id']), array('update' => 'asc', 'class' => 'acciones', 'indicator' => 'loading', 'complete' => '')); ?></td>

            </tr>
            <tr>
                <th colspan="4">Sólo para población desplazada</th>
            </tr>
            <tr>
                <td>Fecha desplazamiento:<?php echo $FamilyPoll['FamilyPoll']['fecha_desplazamiento'] ?> </td>
                <td>Vereda desplazamiento: <?php echo $FamilyPoll['FamilyPoll']['vereda_desplazamiento'] ?></td>
                <td>Corregimiento desplazamiento:  <?php echo $FamilyPoll['FamilyPoll']['corregimiento_desplazamiento'] ?></td>
            </tr>
            <tr>
                <td>Departamento/Municipio:  <?php echo $FamilyPoll['City']['name'] . "" . $FamilyPoll['Departament']['name'] ?></td>
                <td> </td>
                <td>  </td>
            </tr>
            <tr>
                <th colspan="2">Estrato al que pertenece:</th>
                <th ><?php echo $FamilyPoll['FamilyPoll']['estrato'] ?></th>
            </tr>
            <tr>
                <th colspan="2">¿Pertenece alguna asociación de productores, asociación de Distritos de riego y/o Drenaje</th>
                <th ><?php echo $FamilyPoll['FamilyPoll']['pertenece_asociacion'] ?></th>
            </tr>
            <tr>
                <th colspan="2">¿Cuál?</td>
                <th ><?php echo $FamilyPoll['FamilyPoll']['cual_asociacion'] ?></th>
            </tr>

            <tr>
                <th colspan="2">¿Participa en algún tipo de organización productiva?</th>
                <th ><?php echo $FamilyPoll['FamilyPoll']['asociacion_productiva'] ?></th>
            </tr>
            <tr>
                <th colspan="2">¿Participa en organizaciones comunitarias?</th>
                <th ><?php echo $FamilyPoll['FamilyPoll']['asociacion_comunitaria'] ?></th>
            </tr>
            <tr>
                <td colspan="4"> 


                    <fieldset>
                        <br>
                        <?php echo $this->Form->input('FamilyPoll.jac', array('checked' => $FamilyPoll['FamilyPoll']['jac'], 'disabled' => 1, 'label' => 'Junta de Acción Comunal –JAC', 'class' => '')); ?>
                        <br>
                        <?php echo $this->Form->input('FamilyPoll.sindicato', array('checked' => $FamilyPoll['FamilyPoll']['sindicato'], 'disabled' => 1, 'label' => 'Sindicato', 'class' => '')); ?>
                        <br>
                        <?php echo $this->Form->input('FamilyPoll.organizacion', array('checked' => $FamilyPoll['FamilyPoll']['organizacion'], 'disabled' => 1, 'label' => 'Organizaciones de usuarios de Servicios Públicos', 'class' => '')); ?>
                        <br>
                        <?php echo $this->Form->input('FamilyPoll.consejo_juvenil', array('checked' => $FamilyPoll['FamilyPoll']['consejo_juvenil'], 'disabled' => 1, 'label' => 'Consejos Comunales de juventud, cultura, planeación, mujeres, Tutelar', 'class' => '')); ?>
                        <br>
                        <?php echo $this->Form->input('FamilyPoll.comite', array('checked' => $FamilyPoll['FamilyPoll']['comite'], 'disabled' => 1, 'label' => 'Comité de participación comunitaria COPACO', 'class' => '')); ?>
                        <br>                       
                        <?php echo $this->Form->input('FamilyPoll.asociacion_padres', array('checked' => $FamilyPoll['FamilyPoll']['asociacion_padres'], 'disabled' => 1, 'label' => 'Asociación de padres de familia', 'class' => '')); ?>
                        <br>                   
                        <?php echo $this->Form->input('FamilyPoll.cabildo', array('checked' => $FamilyPoll['FamilyPoll']['cabildo'], 'disabled' => 1, 'label' => 'Cabildos Indígenas', 'class' => '')); ?>
                        <br>
                        <?php echo $this->Form->input('FamilyPoll.circulo', array('checked' => $FamilyPoll['FamilyPoll']['circulo'], 'disabled' => 1, 'label' => 'Círculos de paz', 'class' => '')); ?>
                        <br>
                        <?php echo $this->Form->input('FamilyPoll.consejo_comunitario', array('checked' => $FamilyPoll['FamilyPoll']['consejo_comunitario'], 'disabled' => 1, 'label' => 'Consejo comunitarios', 'class' => '')); ?>
                        <br>
                        <?php echo $this->Form->input('FamilyPoll.otro_asociacion', array('checked' => $FamilyPoll['FamilyPoll']['otro_asociacion'], 'disabled' => 1, 'label' => 'Otro', 'class' => '')); ?>
                    </fieldset>


                </td>

            </tr>
        </tbody>
    </table>

<?php endforeach; ?>