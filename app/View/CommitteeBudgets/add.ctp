<?php echo $this->Form->create("CommitteeBudget",array("class"=>"form",  "action"=>"add")); ?>
<?php echo $this->Form->input('CommitteeBudget.id',array('label'=>'id','class' =>''    ));?>
<?php echo $this->Form->input('CommitteeBudget.valor',array('label'=>'valor','class' =>'required'    ));?>
<?php echo $this->Form->input('CommitteeBudget.adjunto',array('label'=>'adjunto','class' =>'required'    ));?>
<?php echo $this->Form->input('CommitteeBudget.observacion',array('label'=>'observacion','class' =>'required'    ));?>
<?php echo $this->Form->end("Guardar")?>
