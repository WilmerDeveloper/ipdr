<fieldset>
<?php echo $this->Form->create("Branch",array("class"=>"form","url"=>array( "action"=>"edit",$this->data['Branch']['id'] ))); ?>
<?php echo $this->Form->hidden('Branch.id' );?>
<?php echo $this->Form->input('Branch.id',array('label'=>'id','class' =>''   ));?>
<?php echo $this->Form->input('Branch.nombre',array('label'=>'Nombre','class' =>''   ));?>
<?php echo $this->Form->input('Branch.codigo',array('label'=>'Código','class' =>''   ));?>
<?php echo $this->Form->input('Branch.director',array('label'=>'Director','class' =>''   ));?>
<?php echo $this->Form->input('Branch.direccion',array('label'=>'Dirección','class' =>''   ));?>
<?php echo $this->Form->input('Branch.telefono',array('label'=>'Teléfono','class' =>''   ));?>
<?php echo $this->Form->input('Branch.departament_id',array('label'=>'Departamento','class' =>''   ));?>
<?php echo $this->Form->end(array("label" => "Guardar", "class" => "submit_button"))?>
</fieldset>
