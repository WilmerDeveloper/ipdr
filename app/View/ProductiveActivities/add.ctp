<?php echo $this->Form->create("ProductiveActivity",array("action"=>"add",'class'=>'form')); ?>
<?php echo $this->Form->input('ProductiveActivity.nombre',array('label'=>'Nombre ','class' =>'required'    ));?>
<?php echo $this->Form->input('ProductiveActivity.tipo',array('label'=>'Tipo','class' =>'required'   ,'empty'=>'','options'=>array('Agricola' => 'Agricola','Pecuario' => 'Pecuario','Forestal' => 'Forestal',) ));?>
<?php echo $this->Form->end("Guardar")?>
