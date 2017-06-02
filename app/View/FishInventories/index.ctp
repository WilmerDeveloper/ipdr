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
		<th><?php echo $this->Paginator->sort('FishInventory.area_espejo','Espejo de agua (Metros)'); ?></th>
		<th><?php echo $this->Paginator->sort('FishInventory.alevinos','Alevinos Sembrados (N°)'); ?></th>
		<th><?php echo $this->Paginator->sort('FishInventory.desechos','Desechos en la parte piscícola:'); ?></th>
		<th><?php echo $this->Paginator->sort('FishInventory.manejo_desechos','Manejo desechos'); ?></th>
		<th></th>
		<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ( $FishInventories as $FishInventory):?>
		<tr>
		<td><?php echo $FishInventory['FishInventory']['area_espejo']; ?></td>
		<td><?php echo $FishInventory['FishInventory']['alevinos']; ?></td>
		<td><?php echo $FishInventory['FishInventory']['desechos']; ?></td>
		<td><?php echo $FishInventory['FishInventory']['manejo_desechos']; ?></td>
		<td><?php echo $this->Ajax->link('Editar',array('controller'=>'FishInventories','action'=>'edit',$FishInventory["FishInventory"]["id"]),array('update'=>'peces', 'class'=>'acciones','indicator'=>'loading')); ?></td>
		<td><?php echo $this->Ajax->link('Eliminar',array('controller'=>'FishInventories','action'=>'delete',$FishInventory["FishInventory"]["id"],$productive_baseline_id),array('update'=>'peces', 'class'=>'acciones','indicator'=>'loading'),'¿Desea eliminar el registro?'); ?></td>
		</tr>
<?php endforeach;?>
	</tbody>
</table>
<?php echo $this->Js->writeBuffer();?>
		<?php echo $this->Ajax->link('Adicionar',array('controller'=>'FishInventories','action'=>'add',$productive_baseline_id),array('update'=>'peces','class'=>'acciones', 'indicator'=>'loading')); ?>
