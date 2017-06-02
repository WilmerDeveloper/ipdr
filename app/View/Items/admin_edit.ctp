<?php
echo $this->Session->flash();
echo $this->Form->create('Item');
echo $this->Form->hidden("Item.id");
echo $this->Form->input("Item.nombre", array('id' => 'usr'));
echo $this->Form->input("Item.controlador", array('id' => 'usr'));
echo $this->Form->input("Item.accion", array('id' => 'usr'));
echo $this->Form->input("Item.icono");
echo $this->Form->input("Item.menu_id");
echo $this->Ajax->submit('Submit', array('url' => array('controller' => 'Items', 'action' => 'edit'), 'update' => 'content', ));
echo $this->Form->end();
?>
<div id="loader" style="display:none;">
    <?php echo $this->Html->image('loading.gif', array('alt' => 'CakePHP')) ?>
</div>
