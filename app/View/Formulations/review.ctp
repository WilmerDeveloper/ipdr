<div>
    <?php echo $this->Form->create("Formulation", array("class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "review", $this->data['Formulation']['id']))); ?>
    <table border="0">
        <tbody>
            <tr>
                <td>Calificación</td>
                <td><?php echo $this->Form->input('Formulation.calificacion_evaluador', array('label' => '', 'class' => 'required' ,'empty'=>'','options'=>array('Corregir'=>'Corregir','Cumple'=>'Cumple'))); ?></td>
            </tr> 
            <tr>
                <td>Concepto</td>
                <td>
                    <?php echo $this->Form->input('Formulation.concepto_evaluador', array('class' => 'required')); ?>
                    <?php echo $this->Form->hidden('Formulation.proyect_id'); ?>
                    <?php echo $this->Form->hidden('Formulation.id'); ?>
                    <?php echo $this->Form->hidden('Formulation.user_id'); ?>
                </td>
            </tr> 
             
        </tbody>
    </table>


    <?php echo $this->Form->end(array('label'=>'Guardar','class'=>'submit_button')) ?>
</div>

<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Formulations', 'action' => 'index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>


