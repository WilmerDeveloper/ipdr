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
		<th><?php echo $this->Paginator->sort('BeekeepingInventory.id','Id'); ?></th>
		<th><?php echo $this->Paginator->sort('BeekeepingInventory.botellas','Botellas'); ?></th>
		<th></th>
		<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ( $BeekeepingInventories as $BeekeepingInventory):?>
		<tr>
		<td><?php echo $BeekeepingInventory['BeekeepingInventory']['id']; ?></td>
		<td><?php echo $BeekeepingInventory['BeekeepingInventory']['botellas']; ?></td>
		<td><?php echo $this->Ajax->link('Editar',array('controller'=>'BeekeepingInventories','action'=>'edit',$BeekeepingInventory["BeekeepingInventory"]["id"]),array('update'=>'abejas','class'=>'acciones','indicator'=>'loading')); ?></td>
		<td><?php echo $this->Ajax->link('Eliminar',array('controller'=>'BeekeepingInventories','action'=>'delete',$BeekeepingInventory["BeekeepingInventory"]["id"],$productive_baseline_id),array('update'=>'abejas','class'=>'acciones','indicator'=>'loading'),'¿Desae eliminar el registro?'); ?></td>
		</tr>
<?php endforeach;?>
	</tbody>
</table>
<?php echo $this->Js->writeBuffer();?>
		<?php echo $this->Ajax->link('Adicionar',array('controller'=>'BeekeepingInventories','action'=>'add',$productive_baseline_id),array('update'=>'abejas','class'=>'acciones','indicator'=>'loading')); ?>
