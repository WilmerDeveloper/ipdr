<?php echo $this->Form->create("Synchronization",array("class"=>"form",  "action"=>"ad")); ?>
<?php echo $this->Form->input('Synchronization.user_id',array('label'=>'user_id','class' =>''    ));?>
<?php echo $this->Form->input('Synchronization.server_id',array('label'=>'server_id','class' =>''    ));?>
<?php echo $this->Form->input('Synchronization.local_id',array('label'=>'local_id','class' =>''    ));?>
<?php echo $this->Form->input('Synchronization.tabla',array('label'=>'tabla','class' =>''    ));?>
<?php echo $this->Form->input('Synchronization.id',array('label'=>'id','class' =>''    ));?>
<?php echo $this->Form->end("Guardar")?>
