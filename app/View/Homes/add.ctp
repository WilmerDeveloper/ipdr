<?php echo $this->Form->create("Home",array("class"=>"form",  "action"=>"add")); ?>
<?php echo $this->Form->input('Home.sala',array('label'=>'Sala','class' =>''    ));?>
<?php echo $this->Form->input('Home.comedor',array('label'=>'Comedor','class' =>''    ));?>
<?php echo $this->Form->input('Home.cocina',array('label'=>'Cocina','class' =>''    ));?>
<?php echo $this->Form->input('Home.banio',array('label'=>'Baño','class' =>''    ));?>
<?php echo $this->Form->end("Guardar")?>
