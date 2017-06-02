<?php echo $this->Session->flash(); ?>

<?php
echo $this->Form->create('User');
echo $this->Form->input("User.nombre", array('label' => 'Nombres', 'id' => 'usr'));
echo $this->Form->input("User.primer_apellido", array('label' => 'Primer Apellido', 'id' => 'usr'));
echo $this->Form->input("User.segundo_apellido", array('label' => 'Segundo Apellido', 'id' => 'usr'));
echo $this->Form->input("User.email", array('label' => 'Correo electrónico', 'id' => 'usr'));
echo $this->Form->input("User.telefono", array('label' => 'Teléfono', 'id' => 'usr'));
echo $this->Form->input("User.username", array('label' => 'Nombre De Usuario', 'id' => 'usr'));
echo $this->Form->input("User.password", array('value' => '', 'label' => 'Contraseña', 'id' => 'usr'));
echo $this->Form->input('User.password_confirm', array('label' => 'Confirmar Contraseña', "type" => 'password', 'value' => '', 'id' => 'usr'));
echo $this->Form->input("User.group_id", array('label' => 'Grupo'));
echo $this->Form->input("User.branch_id", array('label' => 'Entidad'));
?>
<div id="loading" style="display: none;">
    <?php echo $this->Html->image('loading.gif', array('border' => "0", 'align' => 'center')); ?>
</div>
<?php
echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'Users', 'action' => 'add'), 'update' => 'content', 'indicator' => 'loading'));
echo $this->Form->end();
?>
