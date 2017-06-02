<script>

    $(document).ready(function() {


        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#hidricos", beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });
    }

    )
</script>
<div id="hidricos">
    <fieldset><legend>Adición de Recursos Hídricos</legend>
        <?php echo $this->Form->create("WaterResource", array('id' => 'formulario', "action" => "add/" . $property_id)); ?>
        <?php echo $this->Form->hidden('WaterResource.sincronizado', array('value' => 0)); ?>
        <?php echo $this->Form->hidden('WaterResource.property_id', array('value' => $property_id, 'type' => 'text')); ?>
        <?php echo $this->Form->input('WaterResource.recurso_tipo', array('label' => 'Fuente', 'class' => 'required', 'empty' => '', 'options' => array('Río' => 'Río', 'Quebrada' => 'Quebrada', 'Caño' => 'Caño', 'Laguna' => 'Laguna', 'Lago Artificial' => 'Lago Artificial', 'Jagüey' => 'Jagüey', 'Nacimiento' => 'Nacimiento', 'Aljibe' => 'Aljibe', 'Riego Area Regable' => 'Riego Area Regable', 'Pozo Artesiano' => 'Pozo Artesiano'))); ?>
        <?php echo $this->Form->input('WaterResource.tipo_otro', array('label' => '¿Otro Cuál?', 'class' => '')); ?>
        <?php echo $this->Form->input('WaterResource.recurso_cantidad', array('label' => '¿Cantidad?', 'class' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('WaterResource.recurso_nombre', array('label' => 'Nombre de esta fuente', 'class' => '')); ?>
        <fieldset><legend>Tipos de uso del agua</legend>
            <?php echo $this->Form->input('WaterResource.uso_agua_domestico', array('label' => 'Uso de agua Doméstico', 'class' => '', 'type' => 'checkbox')); ?>
            <?php echo $this->Form->input('WaterResource.uso_agua_agricultura', array('label' => 'Uso de agua Agricultura', 'class' => '', 'type' => 'checkbox')); ?>
            <?php echo $this->Form->input('WaterResource.uso_agua_ganaderia', array('label' => 'Uso de agua Ganadería', 'class' => '', 'type' => 'checkbox')); ?>
            <?php echo $this->Form->input('WaterResource.uso_agua_piscicultura', array('label' => 'Uso de agua Piscicultura', 'class' => '', 'type' => 'checkbox')); ?>
        </fieldset> 
        <?php echo $this->Form->input('WaterResource.disponibilidad', array('label' => 'Disponibilidad', 'class' => 'required', 'empty' => '', 'options' => array('Permanente' => 'Permanente', 'Temporal' => 'Temporal'))); ?>
        <?php echo $this->Form->input('WaterResource.estado', array('label' => 'Estado de conservación', 'class' => 'required', 'empty' => '', 'options' => array('Bueno' => 'Bueno', 'Regular' => 'Regular', 'Malo' => 'Malo'))); ?>
        <?php echo $this->Form->input('WaterResource.suficiencia', array('label' => '¿La disponibilidad del agua, tanto para consumo humano como para las explotaciones agropecuarias que adelantarían las familias a asentarse en el predio sería suficiente?', 'class' => 'required', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
        <?php echo $this->Form->input('WaterResource.suficiencia_razon', array('label' => '¿Por qué? (Escriba la principal razón)', 'class' => '')); ?>
        <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>
    </fieldset>
</div>