<script>

    $(document).ready(function() {


        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#especies",
                    beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });
    }

    )
</script>
<div>
    <?php echo $this->Form->create("LivestockSpecy", array("id" => "formulario", 'url' => array('controller' => 'LivestockSpecies', "action" => "edit", $this->data['LivestockSpecy']['id']))); ?>
    <?php echo $this->Form->input('LivestockSpecy.id', array('label' => 'id', 'class' => '')); ?>
    <?php echo $this->Form->input('LivestockSpecy.tipo', array('label' => 'Especie', 'class' => '', 'empty' => '', 'options' => array('Equinos' => 'Equinos', 'Mular' => 'Mular', 'Asnar' => 'Asnar', 'Ovino' => 'Ovino', 'Caprino' => 'Caprino', 'Cunícola' => 'Cunícola', 'Cuyícola' => 'Cuyícola', 'Zoocría' => 'Zoocría', 'Bufalina' => 'Bufalina'))); ?>
    <?php echo $this->Form->input('LivestockSpecy.machos', array('label' => 'Machos', 'class' => '')); ?>
    <?php echo $this->Form->input('LivestockSpecy.hembras', array('label' => 'Hembras', 'class' => '')); ?>
    <?php echo $this->Form->hidden('LivestockSpecy.productive_baseline_id'); ?>
    <?php echo $this->Form->hidden('LivestockSpecy.id'); ?>
     <?php echo $this->Form->hidden('LivestockSpecy.sincronizado', array('value' => 0)); ?>
<?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>
</div>