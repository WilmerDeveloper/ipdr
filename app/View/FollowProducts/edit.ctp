<fieldset>
    <?php echo $this->Form->create("FollowProduct", array("action" => "edit")); ?>
    <?php echo $this->Form->input('FollowProduct.productive_activity_id', array('label' => 'Linea productiva', 'class' => 'required', 'empty' => 'Seleccione')); ?>
    <?php echo $this->Form->input('FollowProduct.cantidad', array('label' => 'Cantidad programada', 'class' => 'required')); ?>
    <?php echo $this->Form->input('FollowProduct.cantidad_real', array('label' => 'Cantidad real', 'class' => 'required')); ?>
    <?php echo $this->Form->hidden('FollowProduct.proyect_id'); ?>
    <?php echo $this->Form->hidden('FollowProduct.id'); ?>
    <br><br>
    <?php 

    echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'FollowProducts', 'action' => 'edit', $this->data['FollowProduct']['id']), 'update' => 'content', 'complete' => 'cargar()', 'indicator' => 'loading'));
    echo $this->Form->end();
?>
</fieldset>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>         
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'FollowProducts', 'action' => 'index', $this->data['FollowProduct']['proyect_id']), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>