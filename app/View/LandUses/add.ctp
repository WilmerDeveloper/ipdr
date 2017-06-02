<script>
    
    $(document).ready(function() {
        
        
        jQuery("#fusos").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#usos_suelo",
                     beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });  }
        
)
</script>
<div >
<?php echo $this->Form->create("LandUse",array("id"=>"fusos",'url'=>array( 'controller' =>'landUses',"action"=>"add",$property_id) )); ?>
<?php echo $this->Form->hidden('LandUse.sincronizado',array('value'=>0    ));?>
<?php echo $this->Form->input('LandUse.nombre',array('label'=>'Uso','class' =>'required'   ,'empty'=>'','options'=>array('Cultivos transitorios' => 'Cultivos transitorios','Cultivos permanentes' => 'Cultivos permanentes','Barbecho' => 'Barbecho','Descanzo' => 'Descanzo','Pastos o forrajes' => 'Pastos o forrajes','Malezas y rastrojos' => 'Malezas y rastrojos','Plantas Permanentes' => 'Plantas Permanentes','Bosques naturales' => 'Bosques naturales','Bosques plantados' => 'Bosques plantados','Cuerpos de agua' => 'Cuerpos de agua','Otros fines'=>'Otros fines') ));?>
<?php echo $this->Form->input('LandUse.unidad',array('label'=>'Unidad','class' =>'required'   ,'empty'=>'','options'=>array('Hectarea' => 'Hectarea','Fanegada plaza o cuadra' => 'Fanegada plaza o cuadra','Metro cuadrado'=>'Metro cuadrado') ));?>
<?php echo $this->Form->input('LandUse.area',array('label'=>'Área','class' =>'required'    ));?>
<?php echo $this->Form->hidden('LandUse.property_id',array('label'=>'property_id','value' =>$property_id ,'type'=>'text'   ));?>
<?php echo $this->Form->end(array('label'=> "Guardar" ,'class'=>'submit_button')) ?>
</div>
