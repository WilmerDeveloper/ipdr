<script>
    
    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#unidad",beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });  }
        
)
</script>
<div id="unidad">
    <fieldset><legend>3.11 Características físico – químicas de las unidades de suelo</legend>
        <?php echo $this->Form->create("FloorUnit", array('id' => 'formulario', "action" => "add/" . $property_id)); ?>
        <?php echo $this->Form->hidden('FloorUnit.id') ?>   
        <?php echo $this->Form->hidden('FloorUnit.sincronizado',array('value'=>0)) ?>  
        <?php echo $this->Form->input('FloorUnit.horizonte', array('label' => 'Horizonte (cm)', 'class' => 'required', 'empty' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('FloorUnit.pendiente', array('label' => 'Pendiente(%)', 'class' => 'required')); ?>
        <?php echo $this->Form->input('FloorUnit.textura', array('label' => 'Textura', 'class' => 'required')); ?>
        <?php echo $this->Form->input('FloorUnit.color', array('label' => 'Color', 'class' => 'required')); ?>
        <?php echo $this->Form->input('FloorUnit.pedregosidad', array('label' => 'Pedregosidad', 'class' => 'required', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
        <?php echo $this->Form->input('FloorUnit.ph', array('label' => 'pH', 'class' => 'required', 'empty' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('FloorUnit.otro', array('label' => 'Otros (Estructura Profundidad Efectiva)', 'class' => 'required')); ?>
    </fieldset>
    <fieldset><legend>3.12 Resumen descripción general de unidades del suelo</legend>
        <?php echo $this->Form->hidden('FloorUnit.property_id', array('value' => $property_id, 'type' => 'text')); ?>
        <?php echo $this->Form->input('FloorUnit.area', array('label' => 'Área', 'class' => 'required')); ?>
        <?php echo $this->Form->input('FloorUnit.erosion', array('label' => 'Erosión', 'class' => 'required', 'empty' => '', 'options' => array('Alta' => 'Alta', 'Moderada' => 'Moderada', 'Baja' => 'Baja', 'No hay' => 'No hay'))); ?>
        <?php echo $this->Form->input('FloorUnit.profundidad_efectiva', array('label' => 'Profundidad efectiva (cm)', 'class' => 'required', 'type' => 'number')); ?>
        <?php echo $this->Form->input('FloorUnit.salinidad', array('label' => 'Salinidad (Grado)', 'class' => 'required', 'empty' => '', 'options' => array('Alta' => 'Alta', 'Moderada' => 'Moderada', 'Baja' => 'Baja', 'No hay' => 'No hay'))); ?>
        <?php echo $this->Form->input('FloorUnit.drenaje', array('label' => 'Drenaje Natural', 'class' => 'required', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
        <?php echo $this->Form->input('FloorUnit.encharcamiento', array('label' => 'Encharcamiento', 'class' => 'required', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
        <?php echo $this->Form->input('FloorUnit.inundabilidad', array('label' => 'Inundabilidad', 'class' => 'required', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
        <?php echo $this->Form->input('FloorUnit.freatico', array('label' => 'Nivel fréatico (cm)', 'class' => 'required', 'empty' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('FloorUnit.area_util', array('label' => 'Área útil (Ha)', 'class' => 'required', 'type' => 'number')); ?>
        <?php echo $this->Form->input('FloorUnit.agrologica', array('label' => 'Clase agrológica', 'empty' => '', 'class' => 'required', 'options' => array('I' => 'I', 'II' => 'II', 'III' => 'III', 'IV' => 'IV', 'V' => 'V', 'VI' => 'VI', 'VII' => 'VII', 'VIII' => 'VIII'))); ?>       
        <?php echo $this->Form->input('FloorUnit.pedregosidad_superficial', array('label' => 'Pedregosidad superficial', 'class' => 'required', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
        <?php echo $this->Form->end(array('label'=> "Guardar" ,'class'=>'submit_button')) ?>
    </fieldset>
</div>