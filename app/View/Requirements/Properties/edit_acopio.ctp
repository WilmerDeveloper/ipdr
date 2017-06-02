<script>


    $(document).ready(function() {
        
        
        jQuery("#form1").validate({
            
            submitHandler: function(form) {
               
                jQuery(form).ajaxSubmit({
                    target: "#<?php if($tipo==1) echo 'acopio';if($tipo==2) echo 'aspectos';;if($tipo==3) echo 'observaciones'?>"
                });
            }
        });  }
        
)
        
</script>


<fieldset>
    <?php echo $this->Form->create("Property", array('id' => 'form1','type'=>'file', 'url' => array('controller' => 'properties', "action" => "edit_acopio", $this->data['Property']['id'], $tipo))); ?>
    <?php echo $this->Form->hidden('Property.id') ?>
    <?php echo $this->Form->hidden('Property.sincronizado', array('value' => 0)); ?>

    <fieldset>
        <?php echo $this->Form->create("Property", array('id' => 'form3', "url" => array('controller' => 'Properties', 'action' => "edit_acopio",$tipo, $this->data['Property']['id']))); ?>
        <?php echo $this->Form->hidden('Property.id') ?>   
        <?php echo $this->Form->hidden('Property.proyect_id') ?>  
        <?php if ($tipo == 1): ?>
            <?php echo $this->Form->input('Property.centro_acopio', array('label' => '3.4 Centro de acopio: (Municipio)', 'class' => '', 'type' => '')); ?>
            <?php echo $this->Form->input('Property.tiempo_centro_acopio', array('label' => '3.5 Tiempo empleado hacia el centro de acopio', 'class' => '', 'type' => 'number')); ?>

        <?php endif; ?>
        <?php if ($tipo == 2): ?>
            <?php echo $this->Form->input('Property.precipitacion_promedio', array('label' => 'Precipitación promedio anual (mm)', 'class' => '', 'type' => 'number')); ?>
            <?php echo $this->Form->input('Property.luminosidad_promedio', array('label' => 'Luminosidad promedio anual', 'class' => '', 'type' => 'number')); ?>
            <?php echo $this->Form->input('Property.temperatura_promedio', array('label' => 'Temperatura promedio anual (ºC)', 'class' => '', 'type' => 'number')); ?>
            <?php echo $this->Form->input('Property.altura_promedio', array('label' => 'Altura sobre el nivel del mar', 'class' => '', 'type' => 'number')); ?>
            <?php echo $this->Form->input('Property.piso', array('label' => 'Piso Térmico', 'class' => '', 'empty' => '', 'options' => array('Cálido' => 'Cálido', 'Templado' => 'Templado', 'Frío' => 'Frío'))); ?>
            <?php echo $this->Form->input('Property.lluvias', array('label' => 'Distribución de las lluvias', 'class' => '', 'empty' => '', 'options' => array('Bimodal' => 'Bimodal', 'Monomodal' => 'Monomodal'))); ?>

        <?php endif; ?>
        <?php if ($tipo == 3): ?>
            <?php echo $this->Form->input('Property.observacion_linea_base', array('label' => 'Observaciones')); ?>
            <?php echo $this->Form->file('Property.archivo_encuesta', array('label' => 'Encuesta en foramto pdf','accept'=>'pdf')); ?>

        <?php endif; ?>

        <?php echo $this->Form->end("Guardar") ?>


    </fieldset>

