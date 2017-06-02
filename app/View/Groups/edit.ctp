<?php echo $this->Session->flash(); ?>
<?php
echo $this->Form->create('Group');
echo $this->Form->hidden("Group.id");
echo $this->Form->input("Group.name");
echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'Groups', 'action' => 'edit',$this->data['Group']['id']), 'update' => 'content', 'indicator'=>'loading'));
echo $this->Form->end();
?>
