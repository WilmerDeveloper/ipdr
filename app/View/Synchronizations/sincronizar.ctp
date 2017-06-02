<?php echo $this->Form->create("Sinchronization"); ?>
<?php echo $this->Form->hidden('Sinchronization.sincronizar', array('value' => 1)); ?>
<?php echo $this->Ajax->submit("Sincronizar datos",array('url'=>array('controller'=>'Synchronizations','action'=>'sincronizar'),'update'=>'content')) ?>
<?php echo $this->Form->end(); ?>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Sinchronizations', 'action' => 'index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>
