<script>
    $(document).ready(function() {
               
        jQuery("#budget_edit").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content",
                    beforeSubmit: function() {
                        $(".submit_button").hide();
                    }
                });
            }
        });  }
)
</script>
<fieldset>
<?php echo $this->Form->create("Budget", array("id" => "budget_edit", 'url' => array("action" => "edit", $this->data['Budget']['id']))); ?>
    <?php echo $this->Form->input('Budget.id'); ?>
    <?php echo $this->Form->hidden('Budget.follow_id'); ?>
    <?php echo $this->Form->input('Budget.monitoring_activity_id', array('label' => 'rubro', 'empty' => '')); ?>
    <?php echo $this->Form->input('Budget.cantidad', array('label' => 'Cantidad', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Budget.valor_unitario', array('label' => 'VALOR UNITARIO EN PESOS', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Budget.cofinanciacion_incoder', array('label' => 'VLR COFINANCIACION INCODER', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Budget.cofinaciacion_comunidad', array('label' => 'VALOR COFINANCIACION COMUNIDAD', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Budget.contapartida_certificada', array('label' => 'VALOR COFINANCIACIÓN CONTRAPARTIDA CERTIFICADA', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Budget.otra_contrapartida', array('label' => 'VALOR COFINANCIACIÓN OTRAS CONTRAPARTIDAS.', 'class' => '','type' => 'number')); ?>
    <?php echo $this->Form->input('Budget.observaciones', array('label' => 'Observaciones', 'class' => '')); ?>
    <?php echo $this->Form->end(array('label'=>'Guardar','class'=>'.submit_button')) ?>
</fieldset>