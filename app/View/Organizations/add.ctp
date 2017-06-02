<script>
    
    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#orga"
                });
            }
        });  }
        
)
</script>
<div id="orga">
    <fieldset>
        <?php echo $this->Form->create("Organization", array('id' => 'formulario', "action" => "add/" . $property_id)); ?>
        <legend>Adición de Asociatividad y/o Organización</legend>
        <?php echo $this->Form->hidden('Property.id', array('label' => 'Esto es property.id' )) ?>   
        <?php echo $this->Form->hidden('Organization.property_id', array('label' => '', 'value' => $property_id, 'type' => 'text')); ?>
        <?php echo $this->Form->input('Organization.tipo', array('label' => 'Tipo de organización', 'class' => '', 'empty'=>'', 'options' => array('Cooperativa' => 'Cooperativa', 'Asociación' => 'Asociación', 'SAT' => 'SAT (Sociedad Agraria de Transformación)', 'JAC' => 'JAC (Junta de Acción Comunal)', 'EAT' => 'EAT (Empresa Asociativa de Trabajo)', '¿Otro?' => '¿Otro?'))); ?>
        <?php echo $this->Form->input('Organization.tipo_otro', array('label' => '¿Cuál?', 'class' => '')); ?>
        <?php echo $this->Form->input('Organization.nombre', array('label' => 'Nombre de la Organización', 'class' => 'required')); ?>
        <?php echo $this->Form->input('Organization.legalidad', array('label' => '¿La organización está constituida legalmente?', 'class' => '', 'empty'=>'', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
        <?php echo $this->Form->input('Organization.sigla', array('label' => 'Sigla de la organización', 'class' => '')); ?>
        <?php echo $this->Form->input('Organization.representante_nombre', array('label' => 'Nombre del representante legal', 'class' => 'required')); ?>
        <?php echo $this->Form->input('Organization.numero_miembros', array('label' => 'Número de miembros', 'class' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Organization.numero_asociados', array('label' => 'Número de asociados', 'class' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Organization.tiempo', array('label' => 'Tiempo de constitución (en años)', 'type' => 'number')); ?>
        <?php echo $this->Form->end("Guardar") ?>
    </fieldset>
</div>