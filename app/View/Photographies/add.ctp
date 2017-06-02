<script>
    $(".form_validate").validate();
</script>
<?php echo $this->Form->create("Photography", array('enctype' => 'multipart/form-data', 'type' => 'file', "class" => "form_validate", 'url' => array("action" => "add", $visit_id))); ?>
<fieldset>
    <?php echo $this->Form->input('Photography.comentario', array('label' => 'Comentario', 'class' => '')); ?><br>
    <?php echo $this->Form->hidden('Photography.id'); ?>
    <?php echo $this->Form->hidden('Photography.visit_id', array('label' => 'visit_id', 'value' => $visit_id)); ?>
    <?php echo $this->Form->file('Photography.fotografia', array('label' => 'Adjuntar fotografía', 'accept' => 'jpg')); ?>
    <?php echo $this->Form->end("Guardar") ?>
</fieldset>
<br>
<br>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Photografies', 'action' => 'index', $visit_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>