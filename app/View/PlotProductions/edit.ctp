<script>

    $(document).ready(function() {


        jQuery("#prod").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#producto",
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
    <?php echo $this->Form->create("PlotProduction", array("id" => "prod", "url" => array("action" => "edit", $this->data['PlotProduction']['id']))); ?>
    <?php echo $this->Form->hidden('PlotProduction.id'); ?>
    <?php echo $this->Form->input('PlotProduction.id', array('label' => 'id', 'class' => '')); ?>
    <?php echo $this->Form->input('PlotProduction.product_id', array('empty' => '', 'label' => 'Producto', 'class' => 'required')); ?>
    <?php echo $this->Form->input('PlotProduction.cantidad', array('label' => 'Cantidad', 'class' => 'required')); ?>
    <?php echo $this->Form->input('PlotProduction.unidad', array('label' => 'Unidad de medida', 'class' => 'required')); ?>
    <?php echo $this->Form->input('PlotProduction.valor', array('label' => 'Valor', 'class' => 'required')); ?>
    <?php echo $this->Form->input('PlotProduction.observaciones', array('label' => 'Observaciones')); ?>
  
    <?php echo $this->Form->hidden('PlotProduction.plot_poll_id', array('label' => 'plot_poll_id')); ?>

    <?php echo $this->Form->end(array("label" => "Guardar", "class" => "submit_button")) ?>
</fieldset>
