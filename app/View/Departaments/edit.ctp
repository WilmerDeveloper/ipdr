<?php echo $this->Form->create("Departament",array("action"=>"edit",'class'=>'form')); ?>
<?php echo $this->Form->hidden('Departament.id' );?>
<?php echo $this->Form->input('Departament.name',array('label'=>'Nombre','class' =>'required', ));?>
<?php echo $this->Form->input('Departament.codigo',array('label'=>'Código','class' =>'required', ));?>
<?php echo $this->Form->end("Guardar")?>
