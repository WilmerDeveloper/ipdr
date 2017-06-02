
<script>
    jQuery(".form").validate({
        submitHandler: function(form) {
            jQuery(form).ajaxSubmit({
                target: "#content", beforeSubmit: function() {
                    $(".submit_button").hide();

                }
            });
        }
    })
</script>

<fieldset>
    <div id="">
        <table border="1">
            <tbody>
                <tr>
                    <td><?php echo $this->data['Requirement']['nombre'] ?></td>

                </tr>

            </tbody>
        </table>

        <?php
        $options = array();
        if ($this->data['Requirement']['tipo'] == "General") {
            $options = array('Muy alto' => 'Muy alto', 'Alto' => 'Alto', 'Medio' => 'Medio', 'Bajo' => 'Bajo', 'Nulo' => 'Nulo');
        } elseif ($this->data['Requirement']['tipo'] == "Seguridad alimentaria" || $this->data['Requirement']['tipo'] == "Componente comercial" || $this->data['Requirement']['tipo'] == "Componente social" || $this->data['Requirement']['tipo'] == "OBJETIVOS-ACTIVIDADES Y METAS" || $this->data['Requirement']['tipo'] == "Caracterización" || $this->data['Requirement']['tipo'] == "Formulación" || $this->data['Requirement']['tipo'] == "Análisis financiero" || $this->data['Requirement']['tipo'] == "Componente ambiental" || $this->data['Requirement']['tipo'] == "Criterios técnicos") {
            $options = array('Nulo' => 'Nulo', 'Bajo' => 'Bajo', 'Bueno' => 'Bueno', 'Excelente' => 'Excelente');
        } elseif ($this->data['Requirement']['tipo'] == "Gastos contrapartida" || $this->data['Requirement']['tipo'] == "Verificación económica" || $this->data['Requirement']['tipo'] == "Asumidos contrapartida") {
            $options = array('Cumple' => 'Cumple', 'No cumple' => 'No cumple', 'No aplica' => 'No aplica');
        } elseif ($this->data['Requirement']['tipo'] == "Aclaración técnica" || $this->data['Requirement']['tipo'] == "Aclaración social" || $this->data['Requirement']['tipo'] == "Aclaración financiera" || $this->data['Requirement']['tipo'] == "Aclaración ambiental") {
            $options = array('Cumple' => 'Cumple', 'No cumple' => 'No cumple');
        } elseif ($this->data['Requirement']['tipo'] == "Rubros no financiables" and $this->Session->read('call_id') == 1) {
            $options = array('No lo contempla' => 'No lo contempla', 'Lo contempla' => 'Lo contempla');
        } elseif ($this->data['Requirement']['tipo'] == "Rubros no financiables" and $this->Session->read('call_id') != 1) {
            $options = array('Cumple' => 'Cumple', 'No cumple' => 'No cumple', 'No aplica' => 'No aplica');
        }
        ?>


        <?php echo $this->Form->create("InitialEvaluationRequirement", array("class" => "form", "action" => "edit/" . $this->data['InitialEvaluationRequirement']['id'] . "/" . $acordeon_id)); ?>

        <?php echo $this->Form->hidden('InitialEvaluationRequirement.id'); ?>
        <?php echo $this->Form->hidden('InitialEvaluationRequirement.initial_evaluation_id', array('type' => 'text')); ?>
        <?php echo $this->Form->hidden('InitialEvaluationRequirement.tipo_requerimiento', array('value' => $this->data['Requirement']['tipo'])); ?>
        <?php echo $this->Form->input('InitialEvaluationRequirement.calificacion', array('label' => 'Calificación', 'class' => 'required', 'empty' => '', 'options' => $options)); ?>

        <?php if ($this->data['Requirement']['tipo'] == "Seguridad alimentaria" || $this->data['Requirement']['tipo'] == "Componente comercial" || $this->data['Requirement']['tipo'] == "Componente social" || $this->data['Requirement']['tipo'] == "OBJETIVOS-ACTIVIDADES Y METAS" || $this->data['Requirement']['tipo'] == "Formulación" || $this->data['Requirement']['tipo'] == "Caracterización" || $this->data['Requirement']['tipo'] == "Análisis financiero" || $this->data['Requirement']['tipo'] == "Componente ambiental" || $this->data['Requirement']['tipo'] == "Criterios técnicos") : ?>


            <?php
            $puntos = array();
            for ($index = 1; $index <= $this->data['Requirement']['puntaje_maximo']; $index++) {
                $puntos[$index] = $index;
            }


            echo $this->Form->hidden('Requerimiento.puntaje_maximo', array('label' => 'Puntaje', 'value' => $this->data['Requirement']['puntaje_maximo'], 'type' => 'text'));
            //echo $this->Form->input('InitialEvaluationRequirement.puntaje', array('label' => 'Puntaje', 'class' => 'required', 'empty' => '', 'options' => $puntos));
            echo $this->Form->input('InitialEvaluationRequirement.concepto', array('label' => 'Concepto', 'class' => '', 'empty' => ''));
            echo $this->Form->input('InitialEvaluationRequirement.preguntas_proponente', array('label' => 'Pregunta a extender al proponente', 'class' => '', 'empty' => ''));
            ?>

        <?php endif; ?>


        <?php echo $this->Form->input('InitialEvaluationRequirement.observaciones', array('label' => 'Observaciones', 'class' => '')); ?>
        <?php echo $this->Form->hidden('InitialEvaluationRequirement.initial_evaluation_id'); ?>

        <table style="width: 70%" border="0"   align="center" >
            <tbody>
                <tr>          
                    <td> <?php echo $this->Form->end(array('label' => "Guardar y continuar", 'class' => 'submit_button')) ?></td>
                    <td>
                        <br>
                        <?php echo $this->Ajax->link('Regresar al listado', array('controller' => 'InitialEvaluations', 'action' => 'edit', $this->data['InitialEvaluationRequirement']['initial_evaluation_id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones submit_button')); ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <br>


</fieldset>