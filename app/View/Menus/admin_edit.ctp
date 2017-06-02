<?php

echo $this->Form->create('Menu');
echo $this->Form->hidden("Menu.id");
echo $this->Form->input("Menu.nombre", array('id' => 'usr'));
echo $this->Form->input("Menu.url", array('id' => 'usr'));
echo $this->Form->input("Menu.icono", array('id' => 'usr'));
echo $this->Form->input("Menu.tab_id");
echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'Menus', 'action' => 'edit'), 'update' => 'content'));
echo $this->Form->end();
echo $this->Html->link("salir", array("action" => "logout"))
?>
