<?php echo $this->Form->create("Asociation",array("class"=>"form",  "action"=>"add")); ?>
<?php echo $this->Form->input('Asociation.tierras',array('label'=>'Tierras','class' =>''    ));?>
<?php echo $this->Form->input('Asociation.oficinas',array('label'=>'Oficinas','class' =>''    ));?>
<?php echo $this->Form->input('Asociation.maquinaria',array('label'=>'Maquinaria','class' =>''    ));?>
<?php echo $this->Form->input('Asociation.herramientas',array('label'=>'Herramientas','class' =>''    ));?>
<?php echo $this->Form->input('Asociation.cultivos',array('label'=>'Cultivos','class' =>''    ));?>
<?php echo $this->Form->input('Asociation.otro_estructura',array('label'=>'otro ¿Cual?','class' =>''    ));?>
<?php echo $this->Form->input('Asociation.centros_acopio',array('label'=>'Centros de acopio','class' =>''    ));?>
<?php echo $this->Form->input('Asociation.decision_consenso',array('label'=>'Consenso','class' =>''    ));?>
<?php echo $this->Form->input('Asociation.decision_director',array('label'=>'Director','class' =>''    ));?>
<?php echo $this->Form->input('Asociation.decision_consejo',array('label'=>'Consejo directivo','class' =>''    ));?>
<?php echo $this->Form->input('Asociation.decision_otro',array('label'=>'otro ¿Cual?','class' =>''    ));?>
<?php echo $this->Form->input('Asociation.decision_no_sabe',array('label'=>'No sabe','class' =>''    ));?>
<?php echo $this->Form->input('Asociation.decision_asamblea',array('label'=>'Asamblea','class' =>''    ));?>
<?php echo $this->Form->end("Guardar")?>
