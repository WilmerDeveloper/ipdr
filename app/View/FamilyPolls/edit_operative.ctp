<script>

    $(document).ready(function() {
        // create the OUTER LAYOUT
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
                    target: "#control_operativo",
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
        <?php echo $this->Form->create("FamilyPoll", array("id" => "ide", 'url' => array('controller' => 'FamilyPolls', "action" => "edit_operative", $this->data['FamilyPoll']['id']))); ?>
        <?php echo $this->Form->input('FamilyPoll.id') ?>
        <table border="1">
            <tr>

                <td>Número de formulario:  </td>
                <td> <?php echo $this->Form->input('FamilyPoll.codigo_formulario', array('label' => '', 'class' => 'required')) ?> </td>
            </tr>
            <tr>
                <td>Fecha visita:  </td>
                <td> <?php echo $this->Form->input('FamilyPoll.fecha_entrevista', array('type' => 'text', 'class' => 'calendario')) ?> </td>
            </tr>
            <tr>
                <td>Número de visitas:  </td>
                <td> <?php echo $this->Form->input('FamilyPoll.numero_visitas', array('label' => '')) ?> </td>
            </tr>
            <tr>
                <td>Entidad del encuestador:  </td>
                <td> <?php echo $this->Form->input('FamilyPoll.nombre_aliado', array('label' => '')) ?> </td>
            </tr>
            <tr>
                <td>Encuestador:  </td>
                <td> <?php echo $this->Form->input('FamilyPoll.nombre_encuestador', array('label' => 'Encuestador')) ?> </td>
            </tr>


        </table> 

        <?php echo $this->Form->hidden('FamilyPoll.sincronizado', array('value' => 0, 'type' => 'text')); ?>
        <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>

    </fieldset>
</div>