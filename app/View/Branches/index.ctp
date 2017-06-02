<div class="paging">
<?php
echo $this->Paginator->options(array('update' => '#content','evalScripts' => false));echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
?>
</div>
<table>
	<thead>
		<tr>
		<th><?php echo $this->Paginator->sort('Branch.id','Id'); ?></th>
		<th><?php echo $this->Paginator->sort('Branch.nombre','Nombre'); ?></th>
		<th><?php echo $this->Paginator->sort('Branch.codigo','Código'); ?></th>
		<th><?php echo $this->Paginator->sort('Branch.director','Director'); ?></th>
		<th><?php echo $this->Paginator->sort('Branch.direccion','Dirección'); ?></th>
		<th><?php echo $this->Paginator->sort('Branch.telefono','Telefono'); ?></th>
		<th></th>
		<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ( $Branches as $Branch):?>
		<tr>
		<td><?php echo $Branch['Branch']['id']; ?></td>
		<td><?php echo $Branch['Branch']['nombre']; ?></td>
		<td><?php echo $Branch['Branch']['codigo']; ?></td>
		<td><?php echo $Branch['Branch']['director']; ?></td>
		<td><?php echo $Branch['Branch']['direccion']; ?></td>
		<td><?php echo $Branch['Branch']['telefono']; ?></td>
		<td><?php echo $this->Ajax->link('Editar',array('controller'=>'Branches','action'=>'edit',$Branch["Branch"]["id"]),array('update'=>'content','indicator'=>'loading','complete'=>'formularioAjax()')); ?></td>
		<td><?php echo $this->Ajax->link('Eliminar',array('controller'=>'Branches','action'=>'delete',$Branch["Branch"]["id"]),array('update'=>'content','indicator'=>'loading','complete'=>'formularioAjax()'),'¿Desea eliminar el registro?'); ?></td>
		</tr>
<?php endforeach;?>
	</tbody>
</table>
<?php echo $this->Js->writeBuffer();?>
		<?php echo $this->Ajax->link('Adicionar',array('controller'=>'Branches','action'=>'add'),array('update'=>'content','indicator'=>'loading','complete'=>'formularioAjax()')); ?>
