<div class="paging">
    <br>    
<?php
echo $this->Paginator->counter(array(
    'format' => 'Página %page% de %pages%, Mostrando %current% registros de %count% totales, empezando en %start%, terminando en %end%'
        )
);
?>
    <br>
<?php
echo $this->Paginator->options(array('update' => '#content','evalScripts' => false));echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
?>
</div>
<table>
	<thead>
		<tr>
		<th><?php echo $this->Paginator->sort('FamilyPoll.id','ID'); ?></th>
		<th><?php echo $this->Paginator->sort('FamilyPoll.nombre_aliado','Nombre aliado'); ?></th>
		<th><?php echo $this->Paginator->sort('FamilyPoll.nombre_encuestador','Nombre encuestador'); ?></th>
		<th><?php echo $this->Paginator->sort('FamilyPoll.fecha_entrevista','Fecha entrevista'); ?></th>
		<th><?php echo $this->Paginator->sort('FamilyPoll.codigo_formulario','Código formulario'); ?></th>
		<th><?php echo $this->Paginator->sort('FamilyPoll.nombre_encuestado','Encuestado'); ?></th>
		<th><?php echo $this->Paginator->sort('Beneficiary.nombres','Cabeza de familia'); ?></th>
		<th></th>
		<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ( $FamilyPolls as $FamilyPoll):?>
		<tr>
		<td><?php echo $FamilyPoll['FamilyPoll']['id']; ?></td>
		<td><?php echo $FamilyPoll['FamilyPoll']['nombre_aliado']; ?></td>
		<td><?php echo $FamilyPoll['FamilyPoll']['nombre_encuestador']; ?></td>
		<td><?php echo $FamilyPoll['FamilyPoll']['fecha_entrevista']; ?></td>
		<td><?php echo $FamilyPoll['FamilyPoll']['codigo_formulario']; ?></td>
		<td><?php echo $FamilyPoll['FamilyPoll']['nombre_encuestado']; ?></td>
		<td><?php echo $FamilyPoll['Beneficiary']['nombres']; ?></td>
		<td><?php echo $this->Ajax->link('Editar',array('controller'=>'FamilyPolls','action'=>'edit',$FamilyPoll["FamilyPoll"]["id"]),array('update'=>'content','indicator'=>'loading','complete'=>'formularioAjax()')); ?></td>
		</tr>
<?php endforeach;?>
	</tbody>
</table>
<?php echo $this->Js->writeBuffer();?>

		<?php if(empty($FamilyPolls)) echo $this->Ajax->link('Adicionar',array('controller'=>'FamilyPolls','action'=>'add',$beneficiary_id),array('update'=>'content','indicator'=>'loading','complete'=>'formularioAjax()')); ?>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Beneficiaries', 'action' => 'poll_index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>