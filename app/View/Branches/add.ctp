<fielset>
<?php echo $this->Form->create("Branch",array("class"=>"form", "url"=>array( "action"=>"add") ) ); ?>
<?php echo $this->Form->input('Branch.id',array('label'=>'id','class' =>''    ));?>
<?php echo $this->Form->input('Branch.nombre',array('label'=>'Nombre','class' =>''    ));?>
<?php echo $this->Form->input('Branch.codigo',array('label'=>'Código','class' =>''    ));?>
<?php echo $this->Form->input('Branch.director',array('label'=>'Director','class' =>''    ));?>
<?php echo $this->Form->input('Branch.direccion',array('label'=>'Dirección','class' =>''    ));?>
<?php echo $this->Form->input('Branch.telefono',array('label'=>'Telefóno','class' =>''    ));?>
<?php echo $this->Form->input('Branch.departament_id',array('label'=>'departament_id','class' =>''    ));?>
<?php echo $this->Form->end(array("label" => "Guardar", "class" => "submit_button"))?>\n</fieldset>
