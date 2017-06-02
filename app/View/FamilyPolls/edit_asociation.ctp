<script>

    $(document).ready(function() {
        $(".calendario").datepicker({
            yearRange: '1900:2050',
            dateFormat: 'yy-mm-dd',
            showOn: 'both',
            buttonImage: './img/calendar.jpg',
            buttonImageOnly: true,
            changeYear: true,
            numberOfMonths: 1

        });

        jQuery("#ide").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#asc",
                     beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });
    }

    )
</script>
<div>
    <fieldset>
        <?php echo $this->Form->create("FamilyPoll", array("id" => "ide", 'url' => array('controller' => 'FamilyPolls', "action" => "edit_asociation", $this->data['FamilyPoll']['id']))); ?>
        <table border="1">
            <tbody>
                <tr>
                    <th colspan="3">Tipo:de poblacion</th>
                </tr>
                <tr>
                    <td colspan="3"><?php echo $this->Form->input('FamilyPoll.grupo_poblacion', array('label' => '', 'class' => '', 'empty' => '', 'options' => array('Campesino'=>'Campesino', 'Mujeres cabeza de hogar' => 'Mujeres cabeza de hogar', 'Indígenas' => 'Indígenas', 'Negritudes' => 'Negritudes', 'Rom' => 'Rom', 'Raizales' => 'Raizales', 'Victimas' => 'Victimas'))); ?> </td>
                </tr>
                <tr>
                    <th colspan="4">Sólo para población desplazada</th>
                </tr>
                <tr>
                    <td>Fecha desplazamiento:<?php echo $this->Form->input('FamilyPoll.fecha_desplazamiento', array('label' => '', 'class' => 'calendario')); ?> </td>
                    <td>Vereda desplazamiento: <?php echo $this->Form->input('FamilyPoll.vereda_desplazamiento', array('label' => '')); ?></td>
                    <td>Corregimiento desplazamiento:  <?php echo $this->Form->input('FamilyPoll.corregimiento_desplazamiento', array('label' => '')); ?></td>
                </tr>
                <tr>
                    <td>Departamento :
                        <?php
                        echo $this->Ajax->observeField('FamilyPollDepartamentoDesplazamiento', array(
                            'url' => array('controller' => 'FamilyPolls', 'action' => 'get_city'),
                            'frequency' => 0.2,
                            'update' => 'ciudad',
                                )
                        );
                        echo $this->Form->input('FamilyPoll.departamento_desplazamiento', array('empty' => '', 'options' => $departaments, 'label' => 'Departamento de desplazamiento', 'class' => '', 'value' => $this->data['Departament']['id']));
                        ?>
                    </td>
                    <td><div id="ciudad">Municipio:<?php echo $this->Form->input('FamilyPoll.ciudad_desplazamiento', array('label' => '', 'empty'=>'Seleccione municipio', 'options' => $cities)); ?></div> </td>
                    <td>  </td>
                </tr>
                <tr>
                    <th colspan="2">Estrato al que pertenece:</th>
                    <th ><?php echo $this->Form->input('FamilyPoll.estrato', array('label' => '')); ?></th>
                </tr>
                <tr>
                    <th colspan="2">¿Pertenece alguna asociación de productores, asociación de Distritos de riego y/o Drenaje</th>
                    <th ><?php echo $this->Form->input('FamilyPoll.pertenece_asociacion', array('label' => '', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?></th>
                </tr>
                <tr>
                    <th colspan="2">¿Cuál?</td>
                    <th ><?php echo $this->Form->input('FamilyPoll.cual_asociacion', array('label' => '', 'class' => '')); ?></th>
                </tr>

                <tr>
                    <th colspan="2">¿Participa en algún tipo de organización productiva?</th>
                    <th ><?php echo $this->Form->input('FamilyPoll.asociacion_productiva', array('label' => '', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?></th>
                </tr>
                <tr>
                    <th colspan="2">¿Participa en organizaciones comunitarias?</th>
                    <th ><?php echo $this->Form->input('FamilyPoll.asociacion_comunitaria', array('label' => '', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?></th>
                </tr>
                <tr>
                    <td colspan="3">
                        <?php echo $this->Form->hidden('FamilyPoll.id'); ?>
                        <br>
                        <br>
                        <?php echo $this->Form->input('FamilyPoll.jac', array('label' => 'Junta de Acción Comunal –JAC', 'class' => '')); ?>
                        <br>
                        <?php echo $this->Form->input('FamilyPoll.sindicato', array('label' => 'Sindicato', 'class' => '')); ?>
                        <br>
                        <?php echo $this->Form->input('FamilyPoll.organizacion', array('label' => 'Organizaciones de usuarios de Servicios Públicos', 'class' => '')); ?>
                        <br>
                        <?php echo $this->Form->input('FamilyPoll.consejo_juvenil', array('label' => 'Consejos Comunales de juventud, cultura, planeación, mujeres, Tutelar', 'class' => '')); ?>
                        <br>
                        <?php echo $this->Form->input('FamilyPoll.comite', array('label' => 'Comité de participación comunitaria COPACO', 'class' => '')); ?>
                        <br>                       
                        <?php echo $this->Form->input('FamilyPoll.asociacion_padres', array('label' => 'Asociación de padres de familia', 'class' => '')); ?>
                        <br>                   
                        <?php echo $this->Form->input('FamilyPoll.cabildo', array('label' => 'Cabildos Indígenas', 'class' => '')); ?>
                        <br>
                        <?php echo $this->Form->input('FamilyPoll.circulo', array('label' => 'Círculos de paz', 'class' => '')); ?>
                        <br>
                        <?php echo $this->Form->input('FamilyPoll.consejo_comunitario', array('label' => 'Consejo comunitarios', 'class' => '')); ?>
                        <br>
                        <?php echo $this->Form->input('FamilyPoll.otro_asociacion', array('label' => 'Otro', 'class' => '')); ?>

                    </td>
                </tr>

            </tbody>
        </table>
        <?php echo $this->Form->hidden('FamilyPoll.sincronizado', array('value' => 0, 'type' => 'text')); ?>
        <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>
    </fieldset>
</div>