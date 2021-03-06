<script>


    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#problem"
                });
            }
        });  }
        
)
        
</script>
<div id="problem">
    <fieldset><legend>5.19 Mencione los  principales problemas en la producción, cosecha y poscosecha en su según grado de importancia. Para cada uno califique de 1 a 5 según la forma en que la producción de su última cosecha fue afectada por los siguientes aspectos:
            Escriba su respuesta donde 1 es “No lo afectó” y 5 es “Estuvo muy afectado”.</legend>
        <?php echo $this->Form->create("ProductiveProblem", array("id" => "formulario", "action" => "edit/" . $this->data['ProductiveProblem']['id'])); ?>
        <?php echo $this->Form->input('ProductiveProblem.id'); ?>
        <?php echo $this->Form->input('ProductiveProblem.tipo', array('label' => 'Problema', 'class' => 'required', 'empty' => '', 'options' => array('Condiciones del terreno' => 'Condiciones del terreno', 'Problemas Climáticos' => 'Problemas Climáticos', 'Problemas de suelos' => 'Problemas de suelos', 'Plagas' => 'Plagas', 'Enfermedades' => 'Enfermedades', 'Problemas asociados al riego' => 'Problemas asociados al riego', 'Calidad de la semilla' => 'Calidad de la semilla', 'Acceso a la tierra' => 'Acceso a la tierra', 'Falta de Recursos Financieros' => 'Falta de Recursos Financieros ',))); ?>
        <?php echo $this->Form->input('ProductiveProblem.valor', array('label' => 'Valor', 'class' => 'required', 'empty' => '', 'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5))); ?>
        <?php echo $this->Form->hidden('ProductiveProblem.productive_poll_id'); ?>
        <?php echo $this->Form->end("Guardar") ?>
    </fieldset>
</div>
