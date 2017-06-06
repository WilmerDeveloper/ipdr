
<?php
echo $this->Session->flash('auth');
echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login')));
?>

<table
    style="width: 100px; text-align: left; margin-left: auto; margin-right: auto;"
    border="0" cellpadding="2" cellspacing="2">
    <tbody>
        <tr>
            <h3 class="form-signin-heading">Ingresar</h3>
        </tr>
        <tr>
            <td><?php echo $this->Form->input('User.username', array('label' => '', 'type' => "text", 'class' => "form-control", 'placeholder' => "Usuario", 'required' => "", 'autofocus' => "")); ?>
</td>
        </tr>
        <tr>
            <td><?php echo $this->Form->input('User.password', array('label' => '', 'type' => "password", 'class' => "form-control", 'placeholder' => "Contraseña", 'required' => "")); ?></td>
        </tr>
        
        <tr>
            <td><?php echo $this->Form->end('Ingresar'); ?></td>
        </tr>
        <tr>
            <td><?php echo $this->Ajax->link('¿Olvidó su usuario o contraseña?', array('controller' => 'Users', "action" => "send"), array('update' => 'content', 'indicator' => 'loading', 'title' => 'Envia un correo para cambiar la contrase&ntilde;a')); ?></td>
        </tr>
    </tbody>
</table>


