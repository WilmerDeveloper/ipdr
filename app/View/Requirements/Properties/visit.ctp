<?php
$l1 = "Se encuentra en la resolución del proyecto";
$l2 = "No se encuentra en la resolución";
?>
<fieldset>
    <?php echo $this->Form->create("Property", array("class" => "form", "action" => "visit/" . $this->data['Property']['id'])); ?>
    <?php echo $this->Form->hidden('Property.id'); ?>
    <table border="0">

        <tbody>
            <?php if ($call_id != 1): ?>
                <tr>
                    <td>SITUACION LEGAL DEL PREDIO:(Explicar brevemente si el predio cuenta con resolución de adjudicación o no,registro,esta en común y proindiviso o parcelas individuales)</td>
                </tr>
                <tr>  
                    <td><?php echo $this->Form->input('Property.situacion_legal', array('label' => '', 'class' => 'required')); ?></td>
                </tr>
                <tr>
                    <td>¿Considera que este predio cumple con los requisitos para ingresar al proyecto?</td>
                </tr>
                <?php
                $l1 = "Cumple";
                $l2 = "No cumple";
                ?>
            <?php endif ?>
            <tr>
                <td><?php echo $this->Form->input('Property.calificacion_visita', array('label' => '', 'class' => 'required', 'empty' => '', 'options' => array('Cumple' => $l1, 'No cumple' => $l2))); ?></td>
            </tr>
            <tr>
                <td>Observaciones</td>
            </tr>
            <tr>
                <td>    <?php echo $this->Form->input('Property.concepto_visita', array('label' => '', 'class' => 'required')); ?></td>
            </tr>
        </tbody>
    </table>


    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submitButton')) ?>
</fieldset>

<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Properties', 'action' => 'resolution_index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>