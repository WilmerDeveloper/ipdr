<script>

    $(document).ready(function() {


        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#sistema_agricola",
                    beforeSubmit: function() {
                        $(".submit_button").hide();

                    }

                });
            }
        });
    }

    )
</script>
<fieldset>
    <?php echo $this->Form->create("AgriculturalSystem", array("id" => "formulario", 'url' => array('controller' => 'AgriculturalSystems', "action" => "add", $baseline_id))); ?>
    <?php echo $this->Form->input('AgriculturalSystem.productive_activity_id', array('label' => 'Cultivo', 'class' => 'required')); ?>
    <?php echo $this->Form->input('AgriculturalSystem.variedad', array('label' => 'Variedad', 'class' => '')); ?>
    <?php echo $this->Form->input('AgriculturalSystem.extension', array('label' => 'Extensión (ha):', 'class' => '')); ?>
    <?php echo $this->Form->input('AgriculturalSystem.densidad', array('label' => 'Densidad de siembra (N° plantas/ha):', 'class' => '')); ?>
    <?php echo $this->Form->input('AgriculturalSystem.distancia_surcos', array('label' => 'Distancia Surcos (m):', 'class' => '')); ?>
    <?php echo $this->Form->input('AgriculturalSystem.distancia_plantas', array('label' => 'Distancia Plantas (m):', 'class' => '')); ?>
    <?php echo $this->Form->input('AgriculturalSystem.edad_cultivo', array('label' => 'Edad cultivo (meses/años):', 'class' => '')); ?>
    <?php echo $this->Form->input('AgriculturalSystem.estado', array('label' => 'Estado fitosanitario:', 'class' => '')); ?>
    <?php echo $this->Form->input('AgriculturalSystem.produccion', array('label' => 'Producción(kg):', 'class' => '')); ?>
    <?php echo $this->Form->input('AgriculturalSystem.autoconsumo', array('label' => 'autoconsumo (kg):', 'class' => '')); ?>
    <?php echo $this->Form->input('AgriculturalSystem.venta', array('label' => 'venta(kg):', 'class' => '')); ?>
    <?php echo $this->Form->input('AgriculturalSystem.fertilizacion', array('label' => 'Fertilización:', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
    <?php echo $this->Form->input('AgriculturalSystem.control_fito_sanitario', array('label' => 'Control fitosanitario', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
    <?php echo $this->Form->input('AgriculturalSystem.labores_culturales', array('label' => 'Labores culturales:', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
    <?php echo $this->Form->input('AgriculturalSystem.tipo', array('label' => 'tipo', 'class' => '')); ?>
    <?php echo $this->Form->hidden('AgriculturalSystem.productive_baseline_id', array('type' => 'text', 'value' => $baseline_id)); ?>
    <?php echo $this->Form->hidden('AgriculturalSystem.sincronizado', array('value' => 0)); ?>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>
</fieldset>
