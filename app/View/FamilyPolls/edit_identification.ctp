<script>

    $(document).ready(function() {


        jQuery("#ide").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#identificacion",
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
        <?php echo $this->Form->create("FamilyPoll", array("id" => "ide", 'url' => array('controller' => 'FamilyPolls', "action" => "edit_identification", $this->data['FamilyPoll']['id']))); ?>
        <table border="1">
            <tr>
                <td>Depertamento: 
                    <?php
                    echo $this->Ajax->observeField('FamilyPollDepartamentId', array(
                        'url' => array('controller' => 'FamilyPolls', 'action' => 'get_city'),
                        'frequency' => 0.2,
                        'update' => 'ciudades',
                            )
                    );
                    echo $this->Form->input('FamilyPoll.departament_id', array('label' => '', 'empty' => 'Seleccione Departamento', 'selected' => $this->data['City']['departament_id']));
                    ?>
                </td>
                <td>Municipio: <div id="ciudades"><?php echo $this->Form->input('FamilyPoll.city_id', array('label' => '', 'class' => 'required')) ?> </div></td>
            </tr>
            <tr>
                <td>Vereda: <?php echo $this->Form->input('FamilyPoll.vereda') ?></td>
                <td>Corregimiento: <?php echo $this->Form->input('FamilyPoll.corregimiento', array('label' => '')) ?></td>
            </tr>
            <tr>
                <td>Predio:</td>
                <td>Área del predio: <?php echo $this->Form->input('FamilyPoll.area_predio', array('label' => '')) ?></td>
            </tr>
            <tr>
                <td>Área de la parcela: <?php echo $this->Form->input('FamilyPoll.area_parcela', array('label' => '')) ?></td>
                <td>Nombre del resguardo: <?php echo $this->Form->input('FamilyPoll.nombre_resguardo', array('label' => '')) ?></td>
            </tr>
            <tr>
                <td>Nombre del consejo comunitario: <?php echo $this->Form->input('FamilyPoll.nombre_resguardo', array('label' => '')) ?></td>
                <td><?php echo $this->Form->input('id') ?></td>
            </tr>

        </table>   
        <?php echo $this->Form->hidden('FamilyPoll.sincronizado', array('value' => 0, 'type' => 'text')); ?>
        <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>

    </fieldset>
</div>