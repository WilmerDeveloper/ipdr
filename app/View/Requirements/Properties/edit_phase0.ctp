<script>

    $(function() {


        $("#formProyecto").validate({
            submitHandler: function(form) {
                $(form).ajaxSubmit({
                    target: "#calificacion",
                    beforeSubmit: function() {
                        $(".submit_button").hide();

                    }

                });
            }


        });
    }


    );
</script>
<fieldset>
    <?php echo $this->Form->create("Property", array('id' => 'formProyecto', "action" => "edit_phase0/" . $this->data['Property']['id'])); ?>

    <?php echo $this->Form->hidden('Property.sincronizado', array('value' => 0)); ?>
    <table border="0">

        <tbody>
            <tr>
                <td><?php echo $this->Form->input('Property.id'); ?></td>
            </tr>
            <tr>
                <td><?php echo $this->Form->input('Property.calificacion_fase0', array('label' => 'calificación', 'empty' => '', 'options' => array('Cumple' => 'Cumple', 'No cumple' => 'No cumple'))); ?></td>
            </tr>
            <tr>
                <td><?php echo $this->Form->input('Property.concepto_fase0', array('label' => 'Concepto')); ?></td>
            </tr>

        </tbody>
    </table>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>


</fieldset>


