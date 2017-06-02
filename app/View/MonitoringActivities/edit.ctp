<?php echo $this->Form->create("MonitoringActivity",array("class"=>"form",  'url'=>array( 'controller'=>'MonitoringActivities', "action"=>"edit"))); ?>
<?php echo $this->Form->input('MonitoringActivity.id');?>
<?php echo $this->Form->input('MonitoringActivity.nombre',array('label'=>'Nombre','class' =>'required'    ));?>
<?php echo $this->Form->input('MonitoringActivity.tipo',array('label'=>'Tipo','class' =>'required'   ,'empty'=>'','options'=>array('Inversiones' => 'Inversiones','Insumos' => 'Insumos','Mano de obra' => 'Mano de obra','Comercialización' => 'Comercialización','Gastos administativos'=>'Gastos administativos') ));?>
<?php echo $this->Form->end("Guardar")?>
