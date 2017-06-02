<script>

    $(document).ready(function() {


        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#porcinos",
                    beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });
    }

    )
</script>
<?php echo $this->Form->create("HogInventory", array("id" => "formulario", 'url' => array('controller' => 'HogInventories', "action" => "edit", $this->data['HogInventory']['id']))); ?>
<div style="border: solid 1px; border-color: #003399">
    <fieldset> 
        <?php echo $this->Form->input('HogInventory.cerdas_madre', array('label' => 'Cerdas madres', 'class' => '')); ?>
        <?php echo $this->Form->input('HogInventory.cerdas_reproduccion', array('label' => 'Cerdas para reposición', 'class' => '')); ?>
        <?php echo $this->Form->input('HogInventory.lechonas_lactantes', array('label' => 'Lechones lactantes y pre-cebo', 'class' => '')); ?>
        <?php echo $this->Form->input('HogInventory.cerdos_levante', array('label' => 'Cerdos en levante', 'class' => '')); ?>
        <?php echo $this->Form->input('HogInventory.cerdos_ceba', array('label' => 'Cerdos en ceba', 'class' => '')); ?>
        <?php echo $this->Form->input('HogInventory.reproductores', array('label' => 'Reproductores', 'class' => '')); ?>
    </fieldset>
</div>
<div style="border: solid 1px; border-color: #003399">Instalaciones (Registre el área en m2 según corresponda):
    <br>
    <fieldset>

        <?php echo $this->Form->input('HogInventory.corrales_seciones_definidas', array('label' => 'Corrales cubiertos  con secciones  definidas', 'class' => '')); ?>
        <?php echo $this->Form->input('HogInventory.corrales_flujo_continuo', array('label' => 'Corrales cubiertos  de flujo continuo', 'class' => '')); ?>
        <?php echo $this->Form->input('HogInventory.corrales_no_tecnificados', array('label' => 'Cochera o corral  tradicional no  tecnificado', 'class' => '')); ?>

    </fieldset>
</div>
<div style="border: solid 1px; border-color: #003399">
    <fieldset>Material del piso:
        <br>
        <?php echo $this->Form->input('HogInventory.cemento', array('label' => 'Cemento', 'class' => '')); ?>
        <?php echo $this->Form->input('HogInventory.cama_profunda', array('label' => 'Cama profunda', 'class' => '')); ?>
        <?php echo $this->Form->input('HogInventory.madera', array('label' => 'Madera', 'class' => '')); ?>
        <?php echo $this->Form->input('HogInventory.plastico', array('label' => 'Plastico', 'class' => '')); ?>
        <?php echo $this->Form->input('HogInventory.otro', array('label' => 'Otro', 'class' => '')); ?>
        <?php echo $this->Form->input('HogInventory.tierra', array('label' => 'Tierra', 'class' => '')); ?>
    </fieldset>
</div>
<div style="border: solid 1px; border-color: #003399">
    <fieldset>Aspectos sanitarios:<br>
        <?php echo $this->Form->input('HogInventory.vacunacion', array('label' => '¿En los 12 últimos 12 meses realizó vacunación contra la peste porcina  clásica en la finca?', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
        <?php echo $this->Form->hidden('HogInventory.productive_baseline_id'); ?>
        <?php echo $this->Form->hidden('HogInventory.id'); ?>
    </fieldset>
</div>
<?php echo $this->Form->hidden('HogInventory.sincronizado', array('value' => 0)); ?>
<?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>

