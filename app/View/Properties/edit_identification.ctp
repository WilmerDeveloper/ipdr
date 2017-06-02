<script>
    $(document).ready(function() {
        jQuery("#form1").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#identificacion",
                     beforeSubmit:function(){
                    $(".submit_button").hide();
                }
                });
            }
        });  }
)
</script>
<fieldset>
    <?php echo $this->Form->create("Property", array('id' => 'form1', 'url' => array('controller' => 'properties', "action" => "edit_identification", $this->data['Property']['id']))); ?>
    <?php echo $this->Form->hidden('Property.id') ?>   
    <?php echo $this->Form->input('Property.proyect_id', array('empty' => 0)) ?> 
    <?php echo $this->Form->hidden('Property.sincronizado', array('value' => 0)); ?>
    <?php
    echo $this->Ajax->observeField('PropertyDepartamentId', array(
        'url' => array('action' => 'select'),
        'frequency' => 0.2,
        'update' => 'ciudades',
            )
    );
    ?>

    <?php echo $this->Form->input('Property.departament_id', array('label' => '1 Departamento', 'empty' => 'Seleccione departamento', 'class' => 'required')); ?>
    <div id="ciudades">
        <?php
        echo $this->Form->input('Property.city_id', array(
            'label' => __('1.2 Municipio', true),
            'empty' => __('Seleccione ciudad', true),
                )
        );
        ?>
    </div>
    <?php echo $this->Form->input('Property.vereda', array('label' => '1.3 Vereda')); ?>
    <?php echo $this->Form->input('Property.corregimiento', array('label' => '1.4 Corregimiento')); ?>
    <?php echo $this->Form->input('Property.nombre', array('label' => '1.5 Nombre del predio', 'class' => 'required')); ?>
    <?php echo $this->Form->input('Property.extension', array('label' => '1.6 Área del predio (En Hectáreas):', 'class' => 'required', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Property.matricula', array('label' => '1.7 Número de Matrícula', 'class' => 'required')); ?>
    <br>
    <legend>1.8 Coordenadas GPS:</legend>
    <?php echo $this->Form->input('Property.georeferencia1', array('label' => 'Georeferenciación (escribir coordenada latitud-grado)', 'class' => 'required', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Property.georeferencia2', array('label' => 'Georeferenciación (escribir coordenadas latitud-minuto)', 'class' => 'required', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Property.georeferencia3', array('label' => 'Georeferenciación (escribir coordenadas latitud-segundo)', 'class' => 'required', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Property.georeferencia4', array('label' => 'Georeferenciación (escribir coordenadas longitud-grado)', 'class' => 'required', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Property.georeferencia5', array('label' => 'Georeferenciación (escribir coordenadas longitud-minuto)', 'class' => 'required', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Property.georeferencia6', array('label' => 'Georeferenciación (escribir coordenadas longitud-segundo)', 'class' => 'required', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Property.numero_parcelas', array('label' => '1.9 Numero de Parcelas en el predio', 'class' => '')); ?>
    <?php echo $this->Form->input('Property.numero_habitantes', array('label' => '1.10 Numero de Familias Habitantes en el predio:', 'class' => '')); ?>
    <?php echo $this->Form->input('Property.nombre_resguardo', array('label' => '1.11 Nombre del Resguardo:', 'class' => '')); ?>
    <?php echo $this->Form->input('Property.nombre_consejo', array('label' => '1.12 Nombre del Consejo Comunitario:', 'class' => '')); ?>
    <?php
    //echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'properties', 'action' => 'baseline', $this->data['Property']['id']), 'update' => 'content', 'indicator' => 'loading'));
   
    ?>
     <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>
</fieldset>