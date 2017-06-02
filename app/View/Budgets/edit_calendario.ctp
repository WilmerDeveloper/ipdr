<?php echo $this->Form->create("Budget", array("class" => "form",'url'=>array( "action" => "edit_calendario",$this->data['Budget']['id']))); ?>
<fieldset>
    <?php echo $this->Form->input('Budget.id'); ?>
    <?php echo $this->Form->hidden('Budget.follow_id'); ?>
    <?php echo $this->Form->input('Budget.monitoring_activity_id', array('label'=>'rubro','empty'=>'','disabled'=>1, )); ?>
  
    <?php echo $this->Form->input('Budget.mes1', array('label' => 'Mes 1', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Budget.mes2', array('label' => 'Mes 2', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Budget.mes3', array('label' => 'Mes 3', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Budget.mes4', array('label' => 'Mes 4', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Budget.mes5', array('label' => 'Mes 5', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Budget.mes6', array('label' => 'Mes 6', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Budget.mes7', array('label' => 'Mes 7', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Budget.mes8', array('label' => 'Mes 8', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Budget.mes9', array('label' => 'Mes 9', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Budget.mes10', array('label' => 'Mes 10', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Budget.mes11', array('label' => 'Mes 11', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Budget.mes12', array('label' => 'Mes 12', 'type' => 'number')); ?>
    <?php echo $this->Form->hidden('Budget.valor_unitario'); ?>
    <?php echo $this->Form->hidden('Budget.cantidad'); ?>
    <?php echo $this->Form->input('Budget.observaciones_mes', array('label' => 'observaciones')); ?>
    <?php echo $this->Form->end(array('label'=>'Guardar','class'=>'submit_button')) ?>
</fieldset>