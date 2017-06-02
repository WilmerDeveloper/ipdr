<script>


    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#activos"
                });
            }
        });  }
        
)
        
</script>
<div id="activos">
<?php echo $this->Form->create("Asset",array("id"=>"formulario",  "action"=>"edit/".$this->data['Asset']['id'])); ?>
<?php echo $this->Form->input('Asset.tipo',array('label'=>'Tipo','class' =>'required'   ,'empty'=>'','options'=>array('Guadaña' => 'Guadaña','Motoazada' => 'Motoazada','Motobombas' => 'Motobombas','Básculas' => 'Básculas','Cosechadoras costales' => 'Cosechadoras costales','Tractor' => 'Tractor','Picadora' => 'Picadora','Bombas espalda' => 'Bombas espalda','Motosierra' => 'Motosierra','Fumigadoras a motor'=>'Fumigadoras a motor','Otro'=>'Otro') ));?>
<?php echo $this->Form->input('Asset.otro',array('label'=>'Otro ¿Cúal?','class' =>''    ));?>
<?php echo $this->Form->hidden('Asset.home_id');?>
<?php echo $this->Form->hidden('Asset.id');?>
<?php echo $this->Form->end("Guardar")?> 
</div>
