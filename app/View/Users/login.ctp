
<?php
echo $this->Session->flash('auth');
echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login')));
?>

<table
    style="width: 100px; text-align: left; margin-left: auto; margin-right: auto;"
    border="0" cellpadding="2" cellspacing="2">
    <tbody>
        <tr>
            <td><h2>Entrada</h2></td>
        </tr>
        <tr>
            <td><?php echo $this->Form->input('User.username', array('label' => 'Usuario', 'title' => 'Nombre de usuario')); ?></td>
        </tr>
        <tr>
            <td><?php echo $this->Form->input('User.password', array('label' => 'Contraseña', 'title' => 'Contraseña')); ?></td>
        </tr>
        
        <tr>
            <td><?php echo $this->Form->end('Ingresar'); ?></td>
        </tr>
        <tr>
            <td><?php echo $this->Ajax->link('¿Olvidó su usuario o contraseña?', array('controller' => 'Users', "action" => "send"), array('update' => 'content', 'indicator' => 'loading', 'title' => 'Envia un correo para cambiar la contrase&ntilde;a')); ?></td>
        </tr>
    </tbody>
</table>


