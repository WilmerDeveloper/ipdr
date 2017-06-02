
<?php echo $this->Form->create("Proyect", array("class" => "form", "action" => "edit/" . $this->data['Proyect']['id'])); ?>
<?php echo $this->Form->hidden('Proyect.sincronizado', array('value' => 0)); ?>
<?php echo $this->Form->input('Proyect.call_id', array('label' => 'Convocatoria')); ?>
<?php echo $this->Form->input('Proyect.codigo', array('label' => 'Código', 'class' => 'required')); ?>
<?php echo $this->Form->hidden('Proyect.id', array('label' => 'id', 'class' => '')); ?>
<?php echo $this->Form->input('Proyect.tipo', array('label' => 'Tipo', 'options'=>array('empty'=>'','Global'=>'Global','Individual'=>'Individual'))); ?>
<?php echo $this->Form->input('Proyect.departament_id', array( 'label' => 'Departamento', 'class' => 'required', 'empty' => 'Seleccione departamento')); ?>
<?php //echo $this->Form->input('Proyect.familias_beneficiadas', array('label' => 'Familias Beneficiadas'));  ?>
<?php //echo $this->Form->input('Proyect.familias_desplazadas', array('label' => 'Familias campesinas'));  ?>
<?php //echo $this->Form->input('Proyect.familias_campesinas', array('label' => 'Familias desplazadas'));  ?>

<?php
echo $this->Ajax->observeField('ProyectDepartamentId', array(
    'url' => array('action' => 'select'),
    'frequency' => 0.2,
    'update' => 'ciudades',
        )
);
?>
<div id="ciudades">
    <?php echo $this->Form->input('Proyect.city_id', array('label' => 'Municipio', 'class' => 'required', 'empty' => 'Seleccione departamento')); ?>

</div>
<?php if($group_id==1) echo $this->Form->input('Proyect.cerrado', array( 'label' => 'Cerrar', 'class' => 'required', 'empty' => 'Seleccione','options'=>array("0"=>"NO","1"=>"SI"))); ?>

<?php //echo $this->Form->input('Proyect.valor', array('label' => 'valor')); ?>
<?php echo $this->Form->end("Guardar") ?>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Proyects', 'action' => 'index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>
