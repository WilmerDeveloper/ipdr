<?php

echo $this->Form->create('Menu');
echo $this->Form->input("Menu.nombre", array('id' => 'usr'));
echo $this->Form->input("Menu.url", array('id' => 'usr'));
echo $this->Form->input("Menu.icono", array('id' => 'usr'));
echo $this->Form->input("Menu.tab_id");
echo $this->Ajax->submit('Submit', array('url' => array('controller' => 'Menus', 'action' => 'add'), 'update' => 'content' ));
echo $this->Form->end();
echo $this->Html->link("salir", array("action" => "logout"))
?>
