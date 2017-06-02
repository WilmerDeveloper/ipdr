<script>


    $(document).ready(function() {


        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#via",
                    beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });
    }

    )
</script>

<div id="via">
    <fieldset>
        <?php echo $this->Form->create("Road", array('id' => 'formulario', "action" => "edit/" . $this->data['Road']['id'])); ?>
        <legend>Edición de  Vías de acceso</legend>
        <?php echo $this->Form->hidden('Road.property_id', array('type' => 'text')); ?>
        <?php echo $this->Form->hidden('Road.sincronizado', array('value' => 0, 'type' => 'text')); ?>
        <?php echo $this->Form->hidden('Road.id', array('type' => 'text')); ?>
        <?php echo $this->Form->input('Road.tipo', array('label' => 'Tipo', 'class' => 'required', 'empty' => '', 'options' => array('Pavimentada' => 'Pavimentada', 'Carreteable' => 'Carreteable', 'Fluvial' => 'Fluvial', 'Camino de herradura' => 'Camino de herradura'))); ?>
        <?php echo $this->Form->input('Road.estado', array('label' => 'Estado', 'class' => '', 'empty' => '', 'options' => array('Bueno' => 'Bueno', 'Regular' => 'Regular', 'Malo' => 'Malo', 'NS/NR' => 'NS/NR'))); ?>
        <?php echo $this->Form->input('Road.distancia', array('label' => 'Distancia en Kilómetros de las vías de acceso', 'class' => 'required')); ?>
        <?php echo $this->Form->input('Road.descripcion', array('label' => 'Descripción de la ruta de acceso', 'class' => '')); ?>
        <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>
    </fieldset>

</div>

