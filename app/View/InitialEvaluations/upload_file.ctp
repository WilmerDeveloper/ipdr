<?php echo $this->Form->create("InitialEvaluation", array('enctype' => 'multipart/form-data', 'type' => 'file', "class" => "", "action" => "uploadFile/" . $evaluation_id)); ?>
<?php echo $this->Form->file('InitialEvaluation.adjunto', array('label' => '', 'accept' => 'xlsx,xls')); ?>
<?php echo $this->Form->end("Guardar")?>