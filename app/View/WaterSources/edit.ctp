<script>


    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#fuentes"
                });
            }
        });  }
        
)
        
</script>
<div id="fuentes">
    <?php echo $this->Form->create("WaterSource", array("id" => "formulario", "action" => "edit/" . $this->data['WaterSource']['id'])); ?>
    <?php echo $this->Form->input('WaterSource.id'); ?>
    <?php echo $this->Form->input('WaterSource.tipo', array('label' => 'Tipo', 'class' => 'required', 'empty' => '', 'options' => array('Acueducto público' => 'Acueducto público', 'Pila pública' => 'Pila pública', 'Río, quebrada, manantial, nacimiento' => 'Río, quebrada, manantial, nacimiento', 'Agua lluvia' => 'Agua lluvia', 'Aguatero' => 'Aguatero', 'Acueducto comunal o veredal' => 'Acueducto comunal o veredal', 'Pozo sin bomba, aljibe o barreno' => 'Pozo sin bomba, aljibe o barreno', 'Pozo con bomba' => 'Pozo con bomba', 'Carrotanque' => 'Carrotanque'))); ?>
    <?php echo $this->Form->hidden('WaterSource.home_id'); ?>
    <?php echo $this->Form->end("Guardar") ?>
</div>