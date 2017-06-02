<div class="paging">
<?php
echo $this->Paginator->options(array('update' => '#content','evalScripts' => false));echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
?>
</div>
<table id="tabla">
	<thead>
		<tr>
		<th><?php echo $this->Paginator->sort('Call.id','Id' ); ?></th>
		<th><?php echo $this->Paginator->sort('Call.nombre','Nombre'); ?></th>
		
		<th></th>
		<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ( $Calls as $Call):?>
		<tr>
		<td><?php echo $Call['Call']['id']; ?></td>
		<td><?php echo $Call['Call']['nombre']; ?></td>
		<td><?php echo $this->Ajax->link('Editar',array('controller'=>'Calls','action'=>'edit',$Call["Call"]["id"]),array('update'=>'content','indicator'=>'loading','complete'=>'formularioAjax()')); ?></td>
		<td><?php echo $this->Ajax->link('Requisitos minimos',array('controller'=>'initialRequirements','action'=>'index',$Call["Call"]["id"]),array('update'=>'content','complete'=>'formularioAjax()' ,'indicator'=>'loading')); ?></td>
		</tr>
<?php endforeach;?>
	</tbody>
</table>
<?php echo $this->Js->writeBuffer();?>
		<?php echo $this->Ajax->link('Adicionar',array('controller'=>'Calls','action'=>'add'),array('update'=>'content','complete'=>'formularioAjax()' ,'indicator'=>'loading')); ?>
