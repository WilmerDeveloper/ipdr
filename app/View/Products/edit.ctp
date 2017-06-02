<?php echo $this->Form->create("Product", array("action" => "add")); ?>
<?php echo $this->Form->input('Product.product_type_id', array('label' => 'Tipo producto', 'class' => 'required', 'empty' => 'Seleccione')); ?>
<?php echo $this->Form->input('Product.cantidad_real', array('label' => 'Cantidad real')); ?>
<?php echo $this->Form->input('Product.valor_unitario', array('label' => 'Valor unitario')); ?>
<?php echo $this->Form->hidden('Product.visit_id'); ?>
<?php echo $this->Form->hidden('Product.id'); ?>
<?php

echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'Products', 'action' => 'edit', $this->data['Product']['visit_id']), 'update' => 'content', 'indicator' => 'loading'));
echo $this->Form->end();
?>
<br>
<br>
<?php echo $this->Ajax->link($this->html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'regresar')), array('controller' => 'Products', 'action' => 'index', $this->data['Product']['visit_id']), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?>