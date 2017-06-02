<?php

echo $this->Form->create('User');
echo $this->Form->input("User.id", array('label' => 'Nombres', 'id' => 'usr'));
echo $this->Form->hidden("User.group_id");
echo $this->Form->input("User.nombre", array('label' => 'Nombres', 'id' => 'usr'));
echo $this->Form->input("User.primer_apellido", array('label' => 'Primer Apellido', 'id' => 'usr'));
echo $this->Form->input("User.segundo_apellido", array('label' => 'Segundo Apellido', 'id' => 'usr'));
echo $this->Form->input("User.email", array('label' => 'Correo electrónico', 'id' => 'usr'));
echo $this->Form->input("User.telefono", array('label' => 'Teléfono', 'id' => 'usr'));
echo $this->Form->input("User.password", array('value' => '', 'label' => 'Contraseña', 'id' => 'usr'));
echo $this->Form->input('User.password_confirm', array('label' => 'Confirmar Contraseña', "type" => 'password', 'value' => '', 'id' => 'usr'));
echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'Users', 'action' => 'edit_user'), 'update' => 'content', 'indicator' => 'loading'));
echo $this->Form->end();
?>
