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
		<th><?php echo $this->Paginator->sort('LivestockSpecy.id','Id'); ?></th>
		<th><?php echo $this->Paginator->sort('LivestockSpecy.tipo','Especie'); ?></th>
		<th><?php echo $this->Paginator->sort('LivestockSpecy.machos','Machos'); ?></th>
		<th><?php echo $this->Paginator->sort('LivestockSpecy.hembras','Hembras'); ?></th>
		<th></th>
		<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ( $LivestockSpecies as $LivestockSpecy):?>
		<tr>
		<td><?php echo $LivestockSpecy['LivestockSpecy']['id']; ?></td>
		<td><?php echo $LivestockSpecy['LivestockSpecy']['tipo']; ?></td>
		<td><?php echo $LivestockSpecy['LivestockSpecy']['machos']; ?></td>
		<td><?php echo $LivestockSpecy['LivestockSpecy']['hembras']; ?></td>
		<td><?php echo $this->Ajax->link('Editar',array('controller'=>'LivestockSpecies','action'=>'edit',$LivestockSpecy["LivestockSpecy"]["id"]),array('update'=>'especies','class'=>'acciones','indicator'=>'loading')); ?></td>
		<td><?php echo $this->Ajax->link('Eliminar',array('controller'=>'LivestockSpecies','action'=>'delete',$LivestockSpecy["LivestockSpecy"]["id"],$productive_baseline_id),array('update'=>'especies','class'=>'acciones','indicator'=>'loading'),'¿Desea eliminar el registro?'); ?></td>
		</tr>
<?php endforeach;?>
	</tbody>
</table>
<?php echo $this->Js->writeBuffer();?>
		<?php echo $this->Ajax->link('Adicionar',array('controller'=>'LivestockSpecies','action'=>'add',$productive_baseline_id),array('update'=>'especies','class'=>'acciones','indicator'=>'loading')); ?>
