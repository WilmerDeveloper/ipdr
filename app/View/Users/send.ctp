<script>
$(document).ready(function(){
    
    $('.boton').click(function(){
        $(this).hide();
        
    })
    
})
</script>
<h1>Por favor ingrese la dirección de correo electrónico registrada en el sistema</h1>
<?php
echo $this->Form->create('User');
echo $this->Form->input("User.correo", array('label' => 'Correo electrónico', 'id' => 'usr'));
echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'Users', 'action' => 'send'), 'update' => 'content','class'=>'boton'));
echo $this->Form->end();
?>


<?php echo $this->Html->link($this->Html->image("regresar.gif", array('width' => '30', 'heigth' => '30', 'alt' => 'regresar', 'align' => 'center')), array('controller' => 'Users', "action" => "login"), array('escape' => false, 'update' => 'content', 'indicator' => 'load')); ?>

