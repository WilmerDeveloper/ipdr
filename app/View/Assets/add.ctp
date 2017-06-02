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
<?php echo $this->Form->create("Asset",array("id"=>"formulario",  "action"=>"add/".$home_id)); ?>
<?php echo $this->Form->input('Asset.tipo',array('label'=>'Tipo','class' =>'required'   ,'empty'=>'','options'=>array('Guadaña' => 'Guadaña','Motoazada' => 'Motoazada','Motobombas' => 'Motobombas','Básculas' => 'Básculas','Cosechadoras costales' => 'Cosechadoras costales','Tractor' => 'Tractor','Picadora' => 'Picadora','Bombas espalda' => 'Bombas espalda','Motosierra' => 'Motosierra','Fumigadoras a motor'=>'Fumigadoras a motor','Otro'=>'Otro') ));?>
<?php echo $this->Form->input('Asset.otro',array('label'=>'Otro ¿Cúal?','class' =>''    ));?>
<?php echo $this->Form->hidden('Asset.home_id',array('value'=>$home_id,'class' =>''    ));?>
<?php echo $this->Form->end("Guardar")?> 
</div>
