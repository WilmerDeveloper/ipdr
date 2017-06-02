<?php echo $this->Form->create("InitialRequirement",array("class"=>"form",  "action"=>"add/".$call_id)); ?>
<?php echo $this->Form->input('InitialRequirement.texto',array('label'=>'Texto','class' =>'required'));?>
<?php echo $this->Form->hidden('InitialRequirement.call_id',array('type'=>'Text','value' =>$call_id));?>
<?php echo $this->Form->input('InitialRequirement.tipo',array('label'=>'Tipo','class' =>'required'   ,'empty'=>'','options'=>array('Predio' => 'Predio','Beneficiario'=>'Beneficiario','Desplazado'=>'Desplazado') ));?>
<?php echo $this->Form->end("Guardar")?>
